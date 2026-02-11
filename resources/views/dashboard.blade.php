<x-app-layout>
    <div class="space-y-8">
        <!-- Top Section: Welcome Card + Mini KPIs -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Welcome Card -->
            <div class="lg:col-span-2 bg-[#FFCB42] rounded-[2.5rem] p-10 flex items-center justify-between relative overflow-hidden shadow-xl shadow-yellow-200/50">
                <div class="relative z-10 max-w-md">
                    <h1 class="text-4xl font-black text-[#1B254B] mb-4">Halo {{ explode(' ', auth()->user()->name)[0] }}!</h1>
                    <p class="text-[#1B254B]/70 font-medium leading-relaxed mb-8">
                        Selamat datang kembali di dashboard analisis Anda. Hari ini ada <span class="font-bold text-[#1B254B]">{{ $surveys->count() }} survei</span> aktif yang siap dianalisis. Mari buat perubahan positif!
                    </p>
                    <a href="{{ route('surveys.create') }}" class="inline-flex items-center px-8 py-3 bg-[#1B254B] text-white rounded-2xl font-bold hover:bg-[#2A355F] transition-all transform hover:-translate-y-1 shadow-lg">
                        Buat Survei Baru
                    </a>
                </div>
                <div class="hidden md:block w-56 h-56 relative z-10 transform translate-x-4 flex items-center justify-center">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full drop-shadow-2xl">
                        <circle cx="100" cy="100" r="80" fill="#1B254B" />
                        <rect x="60" y="80" width="80" height="60" rx="10" fill="#FFF" />
                        <circle cx="100" cy="110" r="10" fill="#FFCB42" />
                        <path d="M70 140 L130 140" stroke="#FFF" stroke-width="4" stroke-linecap="round" />
                    </svg>
                </div>
                <!-- Decorative Circle -->
                <div class="absolute -right-16 -top-16 w-64 h-64 bg-yellow-300 opacity-30 rounded-full"></div>
            </div>

            <!-- Vertical Mini KPIs -->
            <div class="space-y-4 flex flex-col justify-between">
                @php
                    $colors = [
                        ['bg' => '#D0F8F1', 'icon' => 'bg-[#1B254B]/10', 'text' => '#1B254B'],
                        ['bg' => '#EBE8FF', 'icon' => 'bg-[#1B254B]/10', 'text' => '#1B254B'],
                        ['bg' => '#FFD4D4', 'icon' => 'bg-[#1B254B]/10', 'text' => '#1B254B'],
                    ];
                @endphp
                @foreach($kpis->take(3) as $index => $kpi)
                <div class="p-6 rounded-[2rem] flex items-center justify-between shadow-sm transition hover:scale-105 duration-300" style="background-color: {{ $colors[$index]['bg'] }}">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center {{ $colors[$index]['icon'] }}">
                           @if($kpi->kpi_name == 'NPS')
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                           @elseif(Str::contains($kpi->kpi_name, 'Respondents'))
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20V18c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                           @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                           @endif
                        </div>
                        <div>
                            <div class="text-2xl font-black" style="color: {{ $colors[$index]['text'] }}">
                                {{ is_numeric($kpi->kpi_value) ? number_format($kpi->kpi_value, 1) : $kpi->kpi_value }}
                            </div>
                            <div class="text-xs font-bold text-gray-500 uppercase tracking-tighter">{{ $kpi->kpi_name }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Middle Section: Main Charts + Filters -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Left: Table/Activity -->
            <div class="lg:col-span-3 bg-white rounded-[2.5rem] p-8 shadow-sm">
                <div class="flex flex-wrap items-center justify-between gap-4 mb-10">
                    <h2 class="text-2xl font-black text-[#1B254B]">Daftar Survei Populer</h2>
                    
                    <!-- Filters integrated here for modern look -->
                    <form action="{{ route('dashboard') }}" method="GET" class="flex flex-wrap items-center gap-3">
                        <select name="survey" onchange="this.form.submit()" class="rounded-xl border-none bg-gray-100 text-[#1B254B] font-bold text-sm px-4 py-2 focus:ring-2 focus:ring-yellow-400">
                            @foreach($surveys as $s)
                                <option value="{{ $s->id }}" {{ $survey->id == $s->id ? 'selected' : '' }}>{{ $s->title }}</option>
                            @endforeach
                        </select>
                        <select name="region" onchange="this.form.submit()" class="rounded-xl border-none bg-gray-100 text-[#1B254B] font-bold text-sm px-4 py-2 focus:ring-2 focus:ring-yellow-400">
                            <option value="">Semua Wilayah</option>
                            @foreach($regions as $r)
                                <option value="{{ $r->id }}" {{ ($currentFilters['region'] ?? '') == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="space-y-6">
                    @foreach($surveys->take(4) as $s)
                    <div class="flex items-center justify-between p-4 hover:bg-gray-50 rounded-3xl transition group">
                        <div class="flex items-center gap-6">
                            <div class="text-lg font-black text-gray-300 group-hover:text-indigo-600 transition">0{{ $loop->iteration }}</div>
                            <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#1B254B]">{{ $s->title }}</h4>
                                <p class="text-xs text-gray-400">{{ $s->created_at->format('M d, Y') }} • {{ $s->responses_count ?? 0 }} Responden</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-10">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                <span class="text-sm font-bold text-gray-600">{{ rand(1, 10) }}K</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.757a2 2 0 011.708 3.04l-3 5a2 2 0 01-1.708.96H12v2H7v-2H5a2 2 0 01-2-2v-3a2 2 0 012-2h2.242a2 2 0 001.414-.586l1.242-1.242A2 2 0 0111.3 8.3L12 8V5a2 2 0 014 0v5h-2z" /></svg>
                                <span class="text-sm font-bold text-gray-600">{{ rand(1, 5) }}K</span>
                            </div>
                            <div class="text-sm font-black text-[#1B254B] px-3 py-1 bg-yellow-100 rounded-lg">${{ rand(10, 50) }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Right: Small Stats/Calendar -->
            <div class="bg-[#FFE4CC] rounded-[2.5rem] p-6 shadow-sm overflow-hidden flex flex-col">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-black text-[#1B254B]">Analitik Distribusi</h3>
                    <div class="text-xs bg-white/50 px-2 py-1 rounded-lg text-[#1B254B]">Januari</div>
                </div>
                
                <div class="bg-white/40 rounded-3xl p-4 mb-6">
                    <div class="h-40">
                        <canvas id="distributionChart"></canvas>
                    </div>
                </div>

                <div class="space-y-4 flex-grow overflow-y-auto custom-scrollbar pr-2">
                    <div class="border-l-2 border-[#1B254B] pl-4 py-1">
                        <div class="text-xs text-[#1B254B]/50 font-bold uppercase">Update Terakhir</div>
                        <div class="text-sm font-bold text-[#1B254B]">NPS baru saja dikalkulasi ulang</div>
                        <div class="text-[10px] text-gray-500">Oleh Sistem • 2 menit yang lalu</div>
                    </div>
                    <div class="border-l-2 border-yellow-500 pl-4 py-1">
                        <div class="text-xs text-[#1B254B]/50 font-bold uppercase">Notifikasi</div>
                        <div class="text-sm font-bold text-[#1B254B]">Survei Kepuasan Jakarta Selesai</div>
                        <div class="text-[10px] text-gray-500">Oleh Enumerator • 1 jam yang lalu</div>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('surveys.export', array_merge(['survey' => $survey->id], $currentFilters)) }}" class="w-full bg-[#1B254B] text-white py-4 rounded-3xl font-bold flex items-center justify-center gap-2 hover:bg-[#2A355F] transition shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        Export Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('distributionChart');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($distribution->pluck('answer')) !!},
                    datasets: [{
                        data: {!! json_encode($distribution->pluck('total')) !!},
                        backgroundColor: ['#1B254B', '#FF9B9B', '#FFCB42', '#D0F8F1', '#EBE8FF'],
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
