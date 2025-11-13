<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Block;

class BlockController extends Controller
{
    public function index(Request $request)
    {
        $q = Block::orderBy('starts_at');
        $start = $request->query('start_date');
        $end = $request->query('end_date');
        if ($start) {
            try { $startDt = \Carbon\Carbon::parse($start)->startOfDay(); } catch (\Exception $e) { $startDt = null; }
            if ($startDt) $q->where('starts_at', '>=', $startDt->toDateTimeString());
        }
        if ($end) {
            try { $endDt = \Carbon\Carbon::parse($end)->endOfDay(); } catch (\Exception $e) { $endDt = null; }
            if ($endDt) $q->where('starts_at', '<=', $endDt->toDateTimeString());
        }
        $blocks = $q->get();
        $canManage = auth()->check() ? auth()->user()->can('create', Block::class) : false;
        $out = $blocks->map(function($b){
            $start = $b->starts_at ? \Carbon\Carbon::parse($b->starts_at)->setTimezone('UTC') : null;
            $duration = $b->duration_minutes ? intval($b->duration_minutes) : 0;
            $end = $start ? $start->copy()->addMinutes($duration) : null;
            $formatIso = function($dt){ return $dt ? str_replace('+00:00','Z',$dt->toIso8601String()) : null; };
            $startEat = $start ? $start->copy()->setTimezone('Africa/Nairobi') : null;
            $endEat = $end ? $end->copy()->setTimezone('Africa/Nairobi') : null;
            return [
                'id' => $b->id,
                'doctor_id' => $b->doctor_id,
                'starts_at' => $formatIso($start),
                'ends_at' => $formatIso($end),
                'starts_at_eat' => $startEat ? $startEat->format('Y-m-d\TH:i') : null,
                'ends_at_eat' => $endEat ? $endEat->format('Y-m-d\TH:i') : null,
                'starts_at_eat_display' => $startEat ? $startEat->format('g:i A').' EAT' : null,
                'ends_at_eat_display' => $endEat ? $endEat->format('g:i A').' EAT' : null,
                'duration_minutes' => $duration,
                'notes' => $b->notes,
            ];
        });
        return response()->json(['data' => $out, 'can_manage' => $canManage]);
    }
    public function store(Request $request)
    {
        // authorize creation - policy will check admin list/domain
        $this->authorize('create', Block::class);
        $data = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'starts_at' => 'required|date',
            'duration_minutes' => 'nullable|integer',
            'notes' => 'nullable|string',
        ]);

        // normalize incoming starts_at to UTC before storing
        if(!empty($data['starts_at'])){
            try{ $dt = \Carbon\Carbon::parse($data['starts_at'])->setTimezone('UTC'); $data['starts_at'] = $dt->toDateTimeString(); } catch(\Exception $e){}
        }
        $block = Block::create($data);
        $start = $block->starts_at ? \Carbon\Carbon::parse($block->starts_at)->setTimezone('UTC') : null;
        $end = $start ? $start->copy()->addMinutes(intval($block->duration_minutes ?? 0)) : null;
        $formatIso = function($dt){ return $dt ? str_replace('+00:00','Z',$dt->toIso8601String()) : null; };
        $startEat = $start ? $start->copy()->setTimezone('Africa/Nairobi') : null;
        $endEat = $end ? $end->copy()->setTimezone('Africa/Nairobi') : null;
        $resp = [
            'id' => $block->id,
            'doctor_id' => $block->doctor_id,
            'starts_at' => $formatIso($start),
            'ends_at' => $formatIso($end),
            'starts_at_eat' => $startEat ? $startEat->format('Y-m-d\TH:i') : null,
            'ends_at_eat' => $endEat ? $endEat->format('Y-m-d\TH:i') : null,
            'starts_at_eat_display' => $startEat ? $startEat->format('g:i A').' EAT' : null,
            'ends_at_eat_display' => $endEat ? $endEat->format('g:i A').' EAT' : null,
            'duration_minutes' => $block->duration_minutes,
            'notes' => $block->notes,
        ];
        return response()->json(['data' => $resp], 201);
    }

    public function destroy(Block $block)
    {
        $this->authorize('delete', $block);
        $block->delete();
        return response()->json(['deleted' => true]);
    }
}
