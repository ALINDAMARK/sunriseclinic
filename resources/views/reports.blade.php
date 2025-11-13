@extends('layouts.app')

@section('title','Reports - Sun Rise Clinic')

@section('content')
  <div class="h-screen min-h-screen flex flex-col overflow-hidden">
    <header class="flex items-center justify-between px-6 py-3 border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900" style="height:72px;">
      <div>
        <h1 class="text-2xl font-bold">Reports</h1>
        <p class="text-sm text-gray-500">Live clinic analytics and KPI dashboards.</p>
      </div>
    </header>

    {{-- Main area: fixed to remaining viewport height so the page does not scroll --}}
    <main class="flex-1 min-h-0 px-6 py-4">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 h-full" style="height: calc(100vh - 88px);">

        <div class="bg-white dark:bg-gray-900 p-4 rounded-lg border border-gray-200 dark:border-gray-800 h-full overflow-hidden">
          <div class="flex items-start justify-between mb-2">
            <h3 class="font-semibold">Appointments (last 14 days)</h3>
            <div class="space-x-2">
              <button data-export="csv" data-target="appointments" class="text-xs px-2 py-1 bg-gray-100 rounded">CSV</button>
              <button data-export="png" data-target="appointments" class="text-xs px-2 py-1 bg-gray-100 rounded">PNG</button>
            </div>
          </div>
          <div class="h-[calc(50vh-72px)] lg:h-full">
            <canvas id="appointmentsChart" style="width:100%;height:100%;display:block;"></canvas>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-900 p-4 rounded-lg border border-gray-200 dark:border-gray-800 h-full overflow-hidden">
          <div class="flex items-start justify-between mb-2">
            <h3 class="font-semibold">Services usage (top)</h3>
            <div class="space-x-2">
              <button data-export="csv" data-target="services" class="text-xs px-2 py-1 bg-gray-100 rounded">CSV</button>
              <button data-export="png" data-target="services" class="text-xs px-2 py-1 bg-gray-100 rounded">PNG</button>
            </div>
          </div>
          <div class="h-[calc(50vh-72px)] lg:h-full">
            <canvas id="servicesChart" style="width:100%;height:100%;display:block;"></canvas>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-900 p-4 rounded-lg border border-gray-200 dark:border-gray-800 h-full overflow-hidden">
          <div class="flex items-start justify-between mb-2">
            <h3 class="font-semibold">Appointment status breakdown</h3>
            <div class="space-x-2">
              <button data-export="csv" data-target="status" class="text-xs px-2 py-1 bg-gray-100 rounded">CSV</button>
              <button data-export="png" data-target="status" class="text-xs px-2 py-1 bg-gray-100 rounded">PNG</button>
            </div>
          </div>
          <div class="h-[calc(50vh-72px)] lg:h-full">
            <canvas id="statusChart" style="width:100%;height:100%;display:block;"></canvas>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-900 p-4 rounded-lg border border-gray-200 dark:border-gray-800 h-full overflow-hidden">
          <h3 class="font-semibold mb-2">Totals</h3>
          <div class="h-full flex items-center justify-center">
            <ul class="space-y-3 text-sm text-center">
              <li>Total appointments: <span class="block text-2xl font-semibold" id="total_appointments">0</span></li>
              <li>Total patients: <span class="block text-2xl font-semibold" id="total_patients">0</span></li>
              <li>Checked-in: <span class="block text-2xl font-semibold" id="total_checked_in">0</span></li>
            </ul>
          </div>
        </div>

      </div>
    </main>
  </div>

@endsection

@push('head')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@push('scripts')
<script>
  (function(){
    const dataUrl = '/api/reports/data';
    const streamUrl = '/api/reports/stream';
    let apptChart, svcChart, stChart;

    function initCharts(){
      const commonOpts = { responsive: true, maintainAspectRatio: false, animation: { duration: 800, easing: 'easeOutCubic' } };

      const aCtx = document.getElementById('appointmentsChart').getContext('2d');
      apptChart = new Chart(aCtx, {
        type: 'line',
        data: { labels: [], datasets: [{ label: 'Appointments', data: [], borderColor: '#16a34a', backgroundColor: 'rgba(16,163,74,0.08)', fill: true }] },
        options: commonOpts
      });

      const sCtx = document.getElementById('servicesChart').getContext('2d');
      svcChart = new Chart(sCtx, {
        type: 'bar',
        data: { labels: [], datasets: [{ label: 'Service count', data: [], backgroundColor: '#4f46e5' }] },
        options: commonOpts
      });

      const stCtx = document.getElementById('statusChart').getContext('2d');
      stChart = new Chart(stCtx, {
        type: 'doughnut',
        data: { labels: [], datasets: [{ data: [], backgroundColor: ['#10b981','#f59e0b','#ef4444','#6b7280'] }] },
        options: commonOpts
      });
    }

    function animateUpdate(chart){
      // ensure animation settings are applied before update
      chart.options.animation = { duration: 800, easing: 'easeOutCubic' };
      chart.update();
    }

    function updateUI(payload){
      // appointments per day
      const days = Object.keys(payload.appointments_per_day || {});
      const counts = Object.values(payload.appointments_per_day || {});
      apptChart.data.labels = days.map(d => d);
      apptChart.data.datasets[0].data = counts;
      animateUpdate(apptChart);

      // services
      svcChart.data.labels = (payload.services_usage || []).map(s=>s.name);
      svcChart.data.datasets[0].data = (payload.services_usage || []).map(s=>s.count);
      animateUpdate(svcChart);

      // status
      const statusObj = payload.status_counts || {};
      const labels = Object.keys(statusObj);
      const vals = labels.map(k => statusObj[k] || 0);
      stChart.data.labels = labels;
      stChart.data.datasets[0].data = vals;
      animateUpdate(stChart);

      // totals
      document.getElementById('total_appointments').textContent = payload.totals?.total_appointments ?? 0;
      document.getElementById('total_patients').textContent = payload.totals?.total_patients ?? 0;
      document.getElementById('total_checked_in').textContent = payload.totals?.checked_in ?? 0;
    }

    async function fetchOnce(){
      try{
        const res = await fetch(dataUrl, { credentials: 'same-origin' });
        if(res.ok){ const j = await res.json(); updateUI(j); }
      }catch(e){ console.error('reports fetch error', e); }
    }

    function attachExportHandlers(){
      document.querySelectorAll('button[data-export]').forEach(btn => {
        btn.addEventListener('click', (ev)=>{
          const kind = btn.getAttribute('data-export');
          const target = btn.getAttribute('data-target');
          if(kind === 'png') return exportPNG(target);
          if(kind === 'csv') return exportCSV(target);
        });
      });
    }

    function exportPNG(target){
      let chart;
      if(target === 'appointments') chart = apptChart;
      if(target === 'services') chart = svcChart;
      if(target === 'status') chart = stChart;
      if(!chart) return;
      const url = chart.toBase64Image();
      const a = document.createElement('a');
      a.href = url;
      a.download = `report-${target}.png`;
      document.body.appendChild(a);
      a.click();
      a.remove();
    }

    function exportCSV(target){
      let rows = [];
      if(target === 'appointments'){
        const labels = apptChart.data.labels || [];
        const data = apptChart.data.datasets[0].data || [];
        rows.push(['date','count']);
        for(let i=0;i<labels.length;i++) rows.push([labels[i], data[i] ?? 0]);
      }else if(target === 'services'){
        const labels = svcChart.data.labels || [];
        const data = svcChart.data.datasets[0].data || [];
        rows.push(['service','count']);
        for(let i=0;i<labels.length;i++) rows.push([labels[i], data[i] ?? 0]);
      }else if(target === 'status'){
        const labels = stChart.data.labels || [];
        const data = stChart.data.datasets[0].data || [];
        rows.push(['status','count']);
        for(let i=0;i<labels.length;i++) rows.push([labels[i], data[i] ?? 0]);
      }

      const csv = rows.map(r => r.map(c => '"'+String(c).replace(/"/g,'""')+'"').join(',')).join('\n');
      const blob = new Blob([csv], { type: 'text/csv' });
      const url = URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = `report-${target}.csv`;
      document.body.appendChild(a);
      a.click();
      a.remove();
      URL.revokeObjectURL(url);
    }

    document.addEventListener('DOMContentLoaded', () => {
      initCharts();
      attachExportHandlers();
      // First, fetch a snapshot so charts render immediately
      fetchOnce();

      // Try to use Server-Sent Events for live updates; fall back to polling if unavailable
      if (!!window.EventSource) {
        try{
          const es = new EventSource(streamUrl, { withCredentials: true });
          es.onmessage = function(e){
            try{ const payload = JSON.parse(e.data); updateUI(payload); }catch(err){ console.warn('failed to parse sse payload', err); }
          };
          es.onerror = function(e){ console.warn('SSE error, falling back to polling', e); es.close(); setInterval(fetchOnce, 8000); };
        }catch(err){ console.warn('SSE setup failed, falling back to polling', err); setInterval(fetchOnce, 8000); }
      } else {
        // fallback polling
        setInterval(fetchOnce, 8000);
      }
    });
    
  })();
</script>
@endpush
