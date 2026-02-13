{{-- 
    Halaman utama dashboard analitik.
    - Menampilkan sidebar analitik, header filter, kartu metrik, grafik, ringkasan finansial,
      dan tabel orders dalam satu layout aplikasi.
    - Menggunakan tema "light" / "dark" sederhana yang diambil dari query string / cookie.
    - Data utama (survey, filter region/segment, dsb) dikirim dari DashboardController.
--}}
@php
    // Ambil preferensi tema dari query (?theme=light|dark) atau cookie yang pernah disimpan
    $theme = request()->get('theme', request()->cookie('theme', 'light'));
    if (isset($_GET['theme'])) {
        setcookie('theme', $theme, time() + (86400 * 365), '/');
    }
    $bgClass = $theme === 'dark' ? 'bg-gray-900' : 'bg-gray-50';
@endphp

<x-app-layout>
    {{-- 
        Struktur utama:
        - Flex penuh tinggi layar.
        - Kiri: sidebar analitik.
        - Kanan: konten utama (header + isi dashboard).
    --}}
    <div class="flex h-screen overflow-hidden {{ $bgClass }}">
        <!-- Sidebar -->
        <x-dashboard.analytics-sidebar :theme="$theme" />

        <!-- Main Content -->
        <div class="flex-grow flex flex-col min-w-0">
            <!-- Header: berisi judul dashboard + filter survey/region/segment -->
            <x-dashboard.analytics-header :theme="$theme" />

            <!-- Content: grid kartu metrik, grafik, ringkasan finansial, dan tabel orders -->
            <main class="flex-grow overflow-y-auto px-8 py-6">
                <div class="space-y-6">
                    <!-- Top Row - Key Metrics -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <x-dashboard.metric-card 
                            title="Orders" 
                            value="201" 
                            change="↑8.2%"
                            :theme="$theme"
                            icon='<svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>'
                        />
                        
                        <x-dashboard.metric-card 
                            title="Approved" 
                            value="36" 
                            change="↑3.4%"
                            :theme="$theme"
                            icon='<svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
                        />
                        
                        <x-dashboard.metric-card 
                            title="Users" 
                            value="4.890"
                            :theme="$theme"
                            icon='<svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20V18c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>'
                            chart='<div class="h-20"><canvas id="usersChart"></canvas></div>'
                        />
                        
                        <x-dashboard.metric-card 
                            title="Subscriptions" 
                            value="1.201"
                            :theme="$theme"
                            icon='<svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>'
                            chart='<div class="h-20"><canvas id="subscriptionsChart"></canvas></div>'
                        />
                    </div>

                    <!-- Second Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-dashboard.metric-card 
                            title="Month total" 
                            value="$25410" 
                            change="↓0.2%"
                            :theme="$theme"
                            icon='<svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
                        />
                        
                        <x-dashboard.metric-card 
                            title="Revenue" 
                            value="1352" 
                            change="↓1.2%"
                            :theme="$theme"
                            icon='<svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>'
                        />
                    </div>

                    <!-- Charts Row -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <x-dashboard.sales-chart :theme="$theme" />
                        <x-dashboard.activity-chart :theme="$theme" />
                    </div>

                    <!-- Financial Summary -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-dashboard.financial-card 
                            title="Paid Invoices"
                            amount="$30256.23"
                            period="Current Financial Year"
                            change="+15%"
                            :theme="$theme"
                            icon='<svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>'
                        />
                        
                        <x-dashboard.financial-card 
                            title="Funds received"
                            amount="$150256.23"
                            period="Current Financial Year"
                            change="+59%"
                            :theme="$theme"
                            icon='<svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>'
                        />
                    </div>

                    <!-- Orders Table -->
                    <x-dashboard.orders-table 
                        :theme="$theme"
                        :orders="[
                            ['name' => 'Press', 'address' => 'London', 'date' => '22.08.2022', 'status' => 'Delivered', 'price' => '$920'],
                            ['name' => 'Marina', 'address' => 'Man city', 'date' => '24.08.2022', 'status' => 'Processed', 'price' => '$452'],
                            ['name' => 'Alex', 'address' => 'Unknown', 'date' => '18.08.2022', 'status' => 'Cancelled', 'price' => '$1200'],
                            ['name' => 'Robert', 'address' => 'New York', 'date' => '03.08.2022', 'status' => 'Delivered', 'price' => '$1235']
                        ]"
                    />
                </div>
            </main>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const theme = '{{ $theme }}';
            
            // Users Donut Chart
            const usersCtx = document.getElementById('usersChart');
            if (usersCtx) {
                new Chart(usersCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['New', 'Returning', 'Inactive'],
                        datasets: [{
                            data: [62, 26, 12],
                            backgroundColor: ['#FCD34D', '#FB923C', '#9CA3AF'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '70%',
                        plugins: { legend: { display: false } }
                    }
                });
            }

            // Subscriptions Donut Chart
            const subsCtx = document.getElementById('subscriptionsChart');
            if (subsCtx) {
                new Chart(subsCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Paid', 'Trial'],
                        datasets: [{
                            data: [70, 30],
                            backgroundColor: ['#3B82F6', '#9CA3AF'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '70%',
                        plugins: { legend: { display: false } }
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
