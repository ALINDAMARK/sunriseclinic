<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    // Show reports page
    public function index()
    {
        return view('reports');
    }

    // API: return aggregated data for charts
    public function data(Request $request)
    {
        $payload = $this->gatherData();
        return response()->json($payload);
    }

    // Server-Sent Events (SSE) stream endpoint for live updates
    public function stream(Request $request)
    {
        $response = response()->stream(function () {
            // keep sending updates until client disconnects
            while (!connection_aborted()) {
                $payload = $this->gatherData();
                echo "data: " . json_encode($payload) . "\n\n";
                // flush output buffers
                if (function_exists('ob_flush')) { @ob_flush(); }
                if (function_exists('flush')) { @flush(); }
                sleep(5);
            }
        }, 200, [
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache',
            'Connection' => 'keep-alive',
        ]);

        return $response;
    }

    // Helper to build the data payload (used by both data() and stream())
    private function gatherData()
    {
        // Guard tables
        if (!\Illuminate\Support\Facades\Schema::hasTable('appointments')) {
            return [ 'appointments_per_day' => [], 'services_usage' => [], 'status_counts' => [], 'totals' => [] ];
        }

        // Appointments per day - last 14 days
        $days = [];
        for ($i = 13; $i >= 0; $i--) {
            $d = now()->subDays($i)->format('Y-m-d');
            $days[$d] = 0;
        }

        $appts = DB::table('appointments')
            ->select(DB::raw("DATE(starts_at) as day"), DB::raw('count(*) as cnt'))
            ->where('starts_at', '>=', now()->subDays(13)->startOfDay())
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        // convert DB results to typed arrays for safer handling
        $apptsArray = array_map(function($r){
            return ['day' => (string) $r->day, 'count' => (int) $r->cnt];
        }, $appts->toArray());

        foreach ($apptsArray as $r) {
            $dayKey = $r['day'];
            $days[$dayKey] = $r['count'];
        }

        // Services usage (top 10)
        $services = [];
        if (\Illuminate\Support\Facades\Schema::hasTable('services')) {
            $svc = DB::table('appointments')
                ->join('services', 'appointments.service_id', '=', 'services.id')
                ->select('services.name', DB::raw('count(*) as cnt'))
                ->groupBy('services.name')
                ->orderByDesc('cnt')
                ->limit(10)
                ->get();

            $svcArr = array_map(function($s){ return ['name' => (string)$s->name, 'count' => (int)$s->cnt]; }, $svc->toArray());
            foreach ($svcArr as $s) { $services[] = $s; }
        }

        // Status counts
        $statusRows = DB::table('appointments')
            ->select('status', DB::raw('count(*) as cnt'))
            ->groupBy('status')
            ->get()->toArray();

        // convert to associative array: ['status' => count]
        $statusCounts = [];
        foreach ($statusRows as $row) {
            $statusCounts[(string)$row->status] = (int)$row->cnt;
        }

        // Totals
        $totals = [
            'total_appointments' => DB::table('appointments')->count(),
            'total_patients' => \Illuminate\Support\Facades\Schema::hasTable('patients') ? DB::table('patients')->count() : 0,
            'checked_in' => DB::table('appointments')->where('status', 'checked_in')->count(),
        ];

        return [
            'appointments_per_day' => $days,
            'services_usage' => $services,
            'status_counts' => $statusCounts,
            'totals' => $totals,
        ];
    }
}
