<div class="space-y-6">
    <div>
        <h1 class="text-[28px] font-bold text-[#0F172A]">Owner Dashboard</h1>
        <p class="text-sm text-slate-500">UPNEZ Agency OS overview</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <x-metric-tile label="Pipeline Value" value="$ {{ number_format($pipelineValue, 2) }}" />
        <x-metric-tile label="MRR" value="$ {{ number_format($mrr, 2) }}" />
        <x-metric-tile label="Unpaid Invoices" value="{{ $unpaidInvoicesCount }} ($ {{ number_format($unpaidInvoicesTotal,2) }})" />
        <x-metric-tile label="Cash Balance" value="$ {{ number_format($cashBalance, 2) }}" />
        <x-metric-tile label="Bills Due (7 days)" value="{{ $billsDue }}" />
        <x-metric-tile label="Monthly Profit" value="$ {{ number_format($monthlyProfit, 2) }}" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <x-card><h2 class="font-semibold mb-4">Revenue vs Expenses</h2><canvas id="revenueExpensesChart" height="140"></canvas></x-card>
        <x-card><h2 class="font-semibold mb-4">Sales Pipeline Funnel</h2><canvas id="pipelineChart" height="140"></canvas></x-card>
    </div>

    <script>
        document.addEventListener('livewire:navigated', async () => {
            const revenueRes = await fetch('/api/charts/revenue-expenses', { headers: { 'Accept': 'application/json' } });
            if (revenueRes.ok) {
                const data = await revenueRes.json();
                new Chart(document.getElementById('revenueExpensesChart'), { type: 'line', data: { labels: data.labels, datasets: [{ label: 'Revenue', data: data.revenue, borderColor: '#2563EB' }, { label: 'Expenses', data: data.expenses, borderColor: '#DC2626' }] } });
            }

            const pipeRes = await fetch('/api/charts/pipeline-funnel', { headers: { 'Accept': 'application/json' } });
            if (pipeRes.ok) {
                const pipe = await pipeRes.json();
                new Chart(document.getElementById('pipelineChart'), { type: 'bar', data: { labels: Object.keys(pipe), datasets: [{ label: 'Deals', data: Object.values(pipe), backgroundColor: '#F97316' }] } });
            }
        });
    </script>
</div>
