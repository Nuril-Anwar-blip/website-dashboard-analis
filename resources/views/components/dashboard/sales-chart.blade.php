@props(['theme' => 'light'])

@php
    $bgClass = $theme === 'dark' ? 'bg-gray-800' : 'bg-white';
    $borderClass = $theme === 'dark' ? 'border-gray-700' : 'border-gray-200';
    $textClass = $theme === 'dark' ? 'text-white' : 'text-gray-900';
    $selectBgClass = $theme === 'dark' ? 'bg-gray-700' : 'bg-gray-100';
    $selectBorderClass = $theme === 'dark' ? 'border-gray-600' : 'border-gray-200';
@endphp

<div class="{{ $bgClass }} rounded-xl p-6 shadow-sm border {{ $borderClass }}">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-bold {{ $textClass }}">Sales dynamics</h3>
        <select class="px-3 py-1.5 {{ $selectBgClass }} border {{ $selectBorderClass }} rounded-lg text-sm {{ $textClass }}">
            <option>2021</option>
            <option>2022</option>
            <option>2023</option>
        </select>
    </div>
    <div class="h-64">
        <canvas id="salesChart"></canvas>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('salesChart');
    if (ctx) {
        const theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                datasets: [{
                    label: 'Sales',
                    data: [12000, 19000, 15000, 25000, 22000, 30000, 28000, 35000, 32000, 40000, 38000, 45000],
                    backgroundColor: '#3B82F6',
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: theme === 'dark' ? '#9CA3AF' : '#6B7280' },
                        grid: { color: theme === 'dark' ? '#374151' : '#E5E7EB' }
                    },
                    x: {
                        ticks: { color: theme === 'dark' ? '#9CA3AF' : '#6B7280' },
                        grid: { display: false }
                    }
                }
            }
        });
    }
});
</script>

