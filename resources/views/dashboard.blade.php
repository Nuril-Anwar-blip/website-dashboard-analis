{{-- 
    =============================================
    DASHBOARD UTAMA - ANALISIS SURVEY
    =============================================
    
    Deskripsi:
    Dashboard ini menampilkan analisis data survey dengan berbagai metrik dan visualisasi.
    
    Fitur:
    - Sidebar navigasi kiri (responsif: bisa dibuka/tutup di mobile, selalu terlihat di desktop)
    - Header dengan greeting dan tanggal
    - 4 kartu metrik utama (Total revenue, Total orders, Total visitors, Net profit)
    - Chart Revenue (bar chart) - menampilkan data bulanan
    - Chart Sales by Category (donut chart) - distribusi kategori
    - Kartu summary untuk orders dan customers
    - Form upload Excel/CSV yang jelas dan mudah digunakan
    
    Sidebar Navigation:
    - Desktop (> 1024px): Sidebar selalu terlihat di kiri (fixed width 80px)
    - Mobile/Tablet (< 1024px): Sidebar tersembunyi, bisa dibuka dengan tombol hamburger
    - Sidebar mobile muncul sebagai overlay dengan backdrop gelap
    - Sidebar berisi: Dashboard, History, Orders, Surveys, Users, Settings, Logout
    
    Responsivitas:
    - Mobile (< 640px): Sidebar overlay, grid 1 kolom
    - Tablet (640px - 1024px): Sidebar overlay, grid 2 kolom untuk metrik
    - Desktop (> 1024px): Layout penuh dengan sidebar fixed dan grid 4 kolom
--}}
<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
        {{-- Overlay untuk mobile sidebar (muncul saat sidebar dibuka) --}}
        {{-- Overlay ini memberikan efek backdrop gelap saat sidebar dibuka di mobile --}}
        <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden transition-opacity duration-300 opacity-0"></div>
        
        <div class="flex flex-col lg:flex-row">
            {{-- =============================================
                 SIDEBAR NAVIGATION
                 =============================================
                 
                 Sidebar ini berisi menu navigasi utama aplikasi.
                 
                 Desktop (> 1024px):
                 - Selalu terlihat di kiri dengan lebar 80px
                 - Fixed position, tidak bisa ditutup
                 
                 Mobile/Tablet (< 1024px):
                 - Tersembunyi secara default
                 - Bisa dibuka dengan tombol hamburger di header
                 - Muncul sebagai overlay dari kiri
                 - Bisa ditutup dengan klik overlay atau tombol close
                 
                 Menu Items:
                 1. Dashboard - Link ke halaman dashboard
                 2. History/Activity - Riwayat aktivitas (placeholder)
                 3. Orders/Surveys - Link ke daftar survey
                 4. Products/Surveys - Link ke daftar survey
                 5. Customers/Users - Daftar user (placeholder)
                 6. Settings - Link ke halaman profil
                 7. Logout - Form logout
            --}}
            <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-20 bg-white border-r border-gray-200 flex flex-col items-center py-6 space-y-6 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto shadow-xl lg:shadow-none h-screen">
                {{-- Tombol Close untuk Mobile (hanya muncul di mobile) --}}
                <button id="closeSidebarBtn" type="button" class="lg:hidden absolute top-4 right-4 p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors z-10" aria-label="Tutup menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                
                {{-- Logo/Dashboard Icon --}}
                <a href="{{ route('dashboard') }}" class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-lg hover:bg-indigo-700 transition-colors" title="Dashboard">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </a>
                
                {{-- History/Activity Icon --}}
                <a href="#" class="w-12 h-12 rounded-xl flex items-center justify-center text-gray-400 hover:bg-gray-100 transition-colors" title="History">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </a>
                
                {{-- Orders/Surveys Icon --}}
                <a href="{{ route('surveys.index') }}" class="w-12 h-12 rounded-xl flex items-center justify-center text-gray-400 hover:bg-gray-100 transition-colors {{ request()->routeIs('surveys.*') ? 'bg-indigo-50 text-indigo-600' : '' }}" title="Surveys">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </a>
                
                {{-- Products/Surveys Icon --}}
                <a href="{{ route('surveys.index') }}" class="w-12 h-12 rounded-xl flex items-center justify-center text-gray-400 hover:bg-gray-100 transition-colors" title="Products">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </a>
                
                {{-- Customers/Users Icon --}}
                <a href="#" class="w-12 h-12 rounded-xl flex items-center justify-center text-gray-400 hover:bg-gray-100 transition-colors" title="Users">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </a>
                
                {{-- Settings Icon --}}
                <a href="{{ route('profile.edit') }}" class="w-12 h-12 rounded-xl flex items-center justify-center text-gray-400 hover:bg-gray-100 transition-colors mt-auto" title="Settings">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </a>
                
                {{-- Logout Icon --}}
                <form method="POST" action="{{ route('logout') }}" class="mt-auto">
                    @csrf
                    <button type="submit" class="w-12 h-12 rounded-xl flex items-center justify-center text-gray-400 hover:bg-red-50 hover:text-red-600 transition-colors" title="Logout">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </aside>

            {{-- Konten Utama --}}
            <div class="flex-1 w-full">
                {{-- Header - Responsif dengan mobile menu button --}}
                <header class="bg-white border-b border-gray-200 px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center justify-between">
                            {{-- Mobile Menu Button - Membuka sidebar di mobile/tablet --}}
                            <button id="mobileMenuBtn" type="button" class="lg:hidden p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors z-50 relative" aria-label="Buka menu" aria-expanded="false">
                                <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                                <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <div class="ml-4 sm:ml-0">
                                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">
                                    Hello, {{ Auth::user()->name }}! 👋
                                </h1>
                                <p class="text-gray-500 text-xs sm:text-sm">This is what's happening in your store this month.</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 sm:gap-4">
                            <div class="text-xs sm:text-sm text-gray-500 hidden sm:block">
                                Today, {{ now()->format('D d M') }}
                            </div>
                            <select class="px-3 sm:px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-xs sm:text-sm text-gray-700">
                                <option>This month</option>
                                <option>Last month</option>
                                <option>This year</option>
                            </select>
                            <button class="p-2 text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                            <button class="p-2 text-gray-400 hover:text-gray-600 relative">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                            </button>
                            <div class="w-8 h-8 sm:w-10 sm:h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-semibold text-sm sm:text-base">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        </div>
                    </div>
                </header>

                {{-- Konten Dashboard - Responsif dengan padding yang disesuaikan --}}
                <main class="p-4 sm:p-6 lg:p-8">
                    {{-- Grid 4 Kartu Metrik Utama - Responsif: 1 kolom mobile, 2 kolom tablet, 4 kolom desktop --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
                        {{-- NPS (Net Promoter Score) --}}
                        <div class="bg-gradient-to-br from-indigo-600 to-purple-700 rounded-xl sm:rounded-2xl p-4 sm:p-6 text-white shadow-lg">
                            <div class="flex items-center justify-between mb-3 sm:mb-4">
                                <h3 class="text-xs sm:text-sm font-medium opacity-90">Net Promoter Score (NPS)</h3>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                            <p class="text-2xl sm:text-3xl font-bold mb-2">{{ number_format($kpis->where('kpi_name', 'NPS')->first()->kpi_value ?? 0, 1) }}</p>
                            <div class="flex items-center gap-2 text-xs sm:text-sm">
                                <span class="bg-white/20 px-2 py-0.5 rounded-full">Skala -100 s/d 100</span>
                            </div>
                        </div>

                        {{-- Total Respondents --}}
                        <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-sm border border-gray-200">
                            <div class="flex items-center justify-between mb-3 sm:mb-4">
                                <h3 class="text-xs sm:text-sm font-medium text-gray-600">Total Respondents</h3>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20V18c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <p class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">{{ $kpis->where('kpi_name', 'Total Respondents')->first()->kpi_value ?? ($survey->responses_count ?? 0) }}</p>
                            <div class="flex items-center gap-2 text-xs sm:text-sm">
                                <span class="text-indigo-600 font-semibold">Aktif</span>
                                <span class="text-gray-500">Live data</span>
                            </div>
                        </div>

                        {{-- CSAT (Customer Satisfaction Score) --}}
                        <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-sm border border-gray-200">
                            <div class="flex items-center justify-between mb-3 sm:mb-4">
                                <h3 class="text-xs sm:text-sm font-medium text-gray-600">Customer Satisfaction (CSAT)</h3>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                            </div>
                            <p class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">{{ number_format($kpis->where('kpi_name', 'CSAT')->first()->kpi_value ?? 0, 1) }}%</p>
                            <div class="flex items-center gap-2 text-xs sm:text-sm">
                                <span class="text-green-500 font-semibold">Tinggi</span>
                                <span class="text-gray-500">Target > 80%</span>
                            </div>
                        </div>

                        {{-- Satisfaction Index --}}
                        <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-sm border border-gray-200">
                            <div class="flex items-center justify-between mb-3 sm:mb-4">
                                <h3 class="text-xs sm:text-sm font-medium text-gray-600">Indeks Kepuasan</h3>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <p class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">{{ number_format($kpis->where('kpi_name', 'Satisfaction Index')->first()->kpi_value ?? 0, 2) }}</p>
                            <div class="flex items-center gap-2 text-xs sm:text-sm">
                                <span class="text-gray-500">Rata-rata skor skala</span>
                            </div>
                        </div>
                    </div>

                    {{-- Grid Chart dan Summary - Responsif: 1 kolom mobile, 3 kolom desktop --}}
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
                        {{-- Revenue Chart --}}
                        <div class="lg:col-span-2 bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-sm border border-gray-200">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-3">
                                <h3 class="text-base sm:text-lg font-bold text-gray-900">Revenue</h3>
                                <select class="px-3 py-1.5 bg-gray-50 border border-gray-200 rounded-lg text-xs sm:text-sm text-gray-700">
                                    <option>This month vs last</option>
                                    <option>This year</option>
                                </select>
                            </div>
                            <div class="h-48 sm:h-64">
                                <canvas id="revenueChart"></canvas>
                            </div>
                        </div>

                        {{-- Distribution Summary --}}
                        <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-sm border border-gray-200">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-3">
                                <h3 class="text-base sm:text-lg font-bold text-gray-900">Distribusi Jawaban</h3>
                            </div>
                            <div class="h-48 sm:h-64">
                                <canvas id="distributionChart"></canvas>
                            </div>
                        </div>
                    </div>

                    {{-- Summary Cards dan Upload Form - Responsif: 1 kolom mobile, 3 kolom desktop --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                        {{-- Orders Summary --}}
                        <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-sm border border-gray-200">
                            <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-3 sm:mb-4">Orders</h3>
                            <p class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">{{ $kpis->where('kpi_name', 'Total Respondents')->first()->kpi_value ?? ($survey->responses_count ?? 98) }}</p>
                            <p class="text-xs sm:text-sm text-gray-500">12 orders are awaiting confirmation.</p>
                        </div>

                        {{-- Customers Summary --}}
                        <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-sm border border-gray-200">
                            <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-3 sm:mb-4">Customers</h3>
                            <p class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">17</p>
                            <p class="text-xs sm:text-sm text-gray-500">17 customers are waiting for response.</p>
                        </div>

                        {{-- Upload Form --}}
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-sm border-2 border-green-200">
                            <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-3 sm:mb-4 flex items-center gap-2">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                Upload Data Survey
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-600 mb-3 sm:mb-4">Upload file Excel (.xlsx, .xls) atau CSV untuk import data survey.</p>
                            @if(isset($survey))
                                <form action="{{ route('surveys.import', $survey) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                    @csrf
                                    <input type="file" name="file" id="fileInput" accept=".xlsx,.xls,.csv" class="hidden" required onchange="updateFileName(this)">
                                    <label for="fileInput" class="block w-full cursor-pointer">
                                        <div class="bg-white border-2 border-dashed border-green-300 rounded-xl p-3 sm:p-4 text-center hover:border-green-500 transition-colors">
                                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <p class="text-xs text-gray-600 font-medium" id="fileName">Klik untuk upload file</p>
                                        </div>
                                    </label>
                                    <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-xl font-semibold hover:bg-green-700 transition-colors text-xs sm:text-sm">
                                        Import Data
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('surveys.index') }}" class="block w-full bg-green-600 text-white py-2 rounded-xl font-semibold hover:bg-green-700 transition-colors text-xs sm:text-sm text-center">
                                    Pilih Survey Terlebih Dahulu
                                </a>
                            @endif
                        </div>
                    </div>
                </main>
                </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        /**
         * =============================================
         * SIDEBAR MOBILE TOGGLE FUNCTIONALITY
         * =============================================
         * 
         * Fungsi untuk membuka dan menutup sidebar di mobile/tablet.
         * 
         * Cara Kerja:
         * 1. Tombol hamburger (mobileMenuBtn) toggle sidebar (buka/tutup)
         * 2. Tombol close (closeSidebarBtn) menutup sidebar
         * 3. Klik overlay (backdrop gelap) juga menutup sidebar
         * 4. Sidebar menggunakan transform translate untuk animasi smooth
         * 5. Overlay muncul saat sidebar dibuka untuk memberikan efek backdrop
         * 
         * Responsivitas:
         * - Desktop (> 1024px): Sidebar selalu terlihat, fungsi ini tidak aktif
         * - Mobile/Tablet (< 1024px): Sidebar bisa dibuka/tutup
         */
        
        // Inisialisasi saat DOM ready
        let mobileMenuBtn, closeSidebarBtn, sidebar, sidebarOverlay;
        
        // Fungsi untuk inisialisasi elemen
        function initSidebarElements() {
            mobileMenuBtn = document.getElementById('mobileMenuBtn');
            closeSidebarBtn = document.getElementById('closeSidebarBtn');
            sidebar = document.getElementById('sidebar');
            sidebarOverlay = document.getElementById('sidebarOverlay');
            
            // Debug: Log jika elemen tidak ditemukan
            if (!mobileMenuBtn) console.warn('mobileMenuBtn tidak ditemukan');
            if (!closeSidebarBtn) console.warn('closeSidebarBtn tidak ditemukan');
            if (!sidebar) console.warn('sidebar tidak ditemukan');
            if (!sidebarOverlay) console.warn('sidebarOverlay tidak ditemukan');
        }

        /**
         * Fungsi untuk membuka sidebar
         * 
         * Menampilkan sidebar dengan animasi slide dari kiri
         * dan menampilkan overlay backdrop.
         * 
         * Fitur:
         * - Sidebar slide dari kiri dengan animasi smooth
         * - Overlay backdrop muncul dengan fade in
         * - Body scroll di-lock untuk mencegah scroll background
         * - Update aria-expanded untuk accessibility
         */
        function openSidebar() {
            if (!sidebar || !sidebarOverlay || !mobileMenuBtn) {
                console.error('❌ Elemen sidebar tidak lengkap');
                return;
            }
            
            console.log('✅ Membuka sidebar...');
            
            // Tampilkan sidebar dengan animasi slide dari kiri
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            
            // Tampilkan overlay dengan fade in
            sidebarOverlay.classList.remove('hidden');
            // Trigger reflow untuk memastikan transition berjalan
            setTimeout(() => {
                sidebarOverlay.classList.remove('opacity-0');
                sidebarOverlay.classList.add('opacity-100');
            }, 10);
            
            // Update button state
            const menuIcon = document.getElementById('menuIcon');
            const closeIcon = document.getElementById('closeIcon');
            if (menuIcon) menuIcon.classList.add('hidden');
            if (closeIcon) closeIcon.classList.remove('hidden');
            mobileMenuBtn.setAttribute('aria-expanded', 'true');
            
            // Prevent body scroll saat sidebar terbuka (hanya di mobile)
            if (window.innerWidth < 1024) {
                document.body.style.overflow = 'hidden';
                document.body.style.position = 'fixed';
                document.body.style.width = '100%';
            }
            
            console.log('✅ Sidebar berhasil dibuka');
        }

        /**
         * Fungsi untuk menutup sidebar
         * 
         * Menyembunyikan sidebar dengan animasi slide ke kiri
         * dan menyembunyikan overlay backdrop.
         * 
         * Fitur:
         * - Sidebar slide ke kiri dengan animasi smooth
         * - Overlay backdrop hilang dengan fade out
         * - Body scroll di-unlock
         * - Update aria-expanded untuk accessibility
         */
        function closeSidebar() {
            if (!sidebar || !sidebarOverlay || !mobileMenuBtn) {
                console.error('❌ Elemen sidebar tidak lengkap');
                return;
            }
            
            console.log('✅ Menutup sidebar...');
            
            // Sembunyikan sidebar dengan animasi slide ke kiri
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            
            // Sembunyikan overlay dengan fade out
            sidebarOverlay.classList.remove('opacity-100');
            sidebarOverlay.classList.add('opacity-0');
            // Tunggu animasi selesai sebelum hide
            setTimeout(() => {
                if (sidebarOverlay && sidebarOverlay.classList.contains('opacity-0')) {
                    sidebarOverlay.classList.add('hidden');
                }
            }, 300);
            
            // Update button state
            const menuIcon = document.getElementById('menuIcon');
            const closeIcon = document.getElementById('closeIcon');
            if (menuIcon) menuIcon.classList.remove('hidden');
            if (closeIcon) closeIcon.classList.add('hidden');
            if (mobileMenuBtn) {
                mobileMenuBtn.setAttribute('aria-expanded', 'false');
            }
            
            // Restore body scroll
            document.body.style.overflow = '';
            document.body.style.position = '';
            document.body.style.width = '';
            
            console.log('✅ Sidebar berhasil ditutup');
        }

        /**
         * Setup event listeners untuk sidebar
         * 
         * Menambahkan event listener untuk:
         * - Tombol hamburger: toggle sidebar (buka/tutup)
         * - Tombol close: tutup sidebar
         * - Overlay: tutup sidebar saat diklik
         * - Sidebar: prevent close saat klik di dalam sidebar
         */
        function setupSidebarEvents() {
            // Event listener untuk tombol hamburger (toggle sidebar)
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', handleMenuToggle);
                console.log('✅ Mobile menu button event listener terpasang');
            } else {
                console.warn('⚠️ Mobile menu button tidak ditemukan');
            }

            // Event listener untuk tombol close (tutup sidebar)
            if (closeSidebarBtn) {
                closeSidebarBtn.addEventListener('click', handleCloseSidebar);
                console.log('✅ Close sidebar button event listener terpasang');
            } else {
                console.warn('⚠️ Close sidebar button tidak ditemukan');
            }

            // Event listener untuk overlay (tutup sidebar saat klik overlay)
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', handleCloseSidebar);
                console.log('✅ Sidebar overlay event listener terpasang');
            } else {
                console.warn('⚠️ Sidebar overlay tidak ditemukan');
            }

            // Prevent sidebar dari menutup saat klik di dalam sidebar
            if (sidebar) {
                sidebar.addEventListener('click', handleSidebarClick);
                console.log('✅ Sidebar click handler terpasang');
            } else {
                console.warn('⚠️ Sidebar tidak ditemukan');
            }
        }

        /**
         * Handler untuk toggle menu (buka/tutup sidebar)
         * 
         * Fungsi ini dipanggil saat tombol hamburger diklik.
         * Jika sidebar terbuka, tutup; jika tertutup, buka.
         */
        function handleMenuToggle(e) {
            e.preventDefault();
            e.stopPropagation();
            
            console.log('🔘 Tombol hamburger diklik');
            
            if (!sidebar) {
                console.error('❌ Sidebar tidak ditemukan');
                return;
            }
            
            // Cek apakah sidebar sedang terbuka
            const isOpen = sidebar.classList.contains('translate-x-0');
            console.log('📊 Status sidebar:', isOpen ? 'Terbuka' : 'Tertutup');
            
            if (isOpen) {
                console.log('🔽 Menutup sidebar...');
                closeSidebar();
            } else {
                console.log('🔼 Membuka sidebar...');
                openSidebar();
            }
        }

        /**
         * Handler untuk menutup sidebar
         */
        function handleCloseSidebar(e) {
            e.preventDefault();
            e.stopPropagation();
            closeSidebar();
        }

        /**
         * Handler untuk klik di dalam sidebar (prevent close)
         */
        function handleSidebarClick(e) {
            e.stopPropagation();
        }

        /**
         * Setup auto-close sidebar saat link diklik (untuk mobile)
         */
        function setupSidebarAutoClose() {
            if (!sidebar) return;
            
            const sidebarLinks = sidebar.querySelectorAll('a, button[type="submit"]');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Hanya tutup di mobile/tablet (bukan desktop)
                    if (window.innerWidth < 1024) {
                        const href = this.getAttribute('href');
                        // Jangan tutup jika link adalah anchor kosong (#) atau form logout
                        if (href && href !== '#' && !this.closest('form')) {
                            // Delay sedikit untuk memastikan navigasi terjadi
                            setTimeout(() => {
                                closeSidebar();
                            }, 150);
                        }
                    }
                });
            });
        }

        /**
         * Handle resize window - reset sidebar state saat resize
         */
        function setupResizeHandler() {
            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    // Jika resize ke desktop, pastikan sidebar terlihat dan overlay tersembunyi
                    if (window.innerWidth >= 1024) {
                        if (sidebar) {
                            sidebar.classList.remove('-translate-x-full');
                            sidebar.classList.add('translate-x-0');
                        }
                        if (sidebarOverlay) {
                            sidebarOverlay.classList.add('hidden');
                            sidebarOverlay.classList.remove('opacity-100');
                            sidebarOverlay.classList.add('opacity-0');
                        }
                        document.body.style.overflow = '';
                        document.body.style.position = '';
                        document.body.style.width = '';
                    } else {
                        // Jika resize ke mobile, pastikan sidebar tersembunyi jika belum terbuka
                        if (sidebar && !sidebar.classList.contains('translate-x-0')) {
                            sidebar.classList.add('-translate-x-full');
                            sidebar.classList.remove('translate-x-0');
                        }
                    }
                }, 250);
            });
        }

        /**
         * Handle escape key untuk menutup sidebar
         */
        function setupEscapeKeyHandler() {
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && window.innerWidth < 1024) {
                    if (sidebar && sidebar.classList.contains('translate-x-0')) {
                        closeSidebar();
                    }
                }
            });
        }

        /**
         * Update nama file yang dipilih untuk ditampilkan di UI
         */
        function updateFileName(input) {
            const fileName = input.files[0]?.name || 'Klik untuk upload file';
            document.getElementById('fileName').textContent = fileName;
        }

        /**
         * Inisialisasi semua fungsi saat DOM ready
         */
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi elemen sidebar
            initSidebarElements();
            
            // Setup event listeners untuk sidebar
            setupSidebarEvents();
            
            // Setup auto-close saat link diklik
            setupSidebarAutoClose();
            
            // Setup resize handler
            setupResizeHandler();
            
            // Setup escape key handler
            setupEscapeKeyHandler();
            
            // Inisialisasi Chart.js untuk Revenue dan Category charts
            // Revenue Chart (Bar Chart)
            const revenueCtx = document.getElementById('revenueChart');
            if (revenueCtx) {
                new Chart(revenueCtx, {
                    type: 'bar',
                    data: {
                        labels: ['1 AUG', '2 AUG', '3 AUG', '4 AUG', '5 AUG', '6 AUG', '7 AUG', '8 AUG'],
                        datasets: [{
                            label: 'Revenue',
                            data: [8500, 12000, 9800, 14867, 11200, 13500, 14200, 16000],
                            backgroundColor: '#8B5CF6',
                            borderRadius: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return '$' + context.parsed.y.toLocaleString();
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return '$' + (value / 1000) + 'K';
                                    }
                                },
                                grid: { color: '#F3F4F6' }
                            },
                            x: {
                                grid: { display: false }
                            }
                        }
                    }
                });
            }

            // Response Distribution Chart (Doughnut/Pie)
            const distCtx = document.getElementById('distributionChart');
            if (distCtx) {
                const labels = {!! json_encode($distribution->pluck('answer')) !!};
                const values = {!! json_encode($distribution->pluck('total')) !!};
                
                new Chart(distCtx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: values,
                            backgroundColor: [
                                '#4F46E5', '#8B5CF6', '#EC4899', '#EF4444', '#F59E0B', 
                                '#10B981', '#3B82F6', '#6366F1', '#A855F7', '#D946EF'
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '70%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 15,
                                    usePointStyle: true,
                                    font: { size: 11 }
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
