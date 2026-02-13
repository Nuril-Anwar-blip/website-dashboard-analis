@props(['reports' => []])

<div class="bg-gradient-to-br from-orange-500 via-orange-600 to-orange-500 rounded-2xl p-6 shadow-xl text-white relative overflow-hidden group">
    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent animate-shimmer opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
    
    <div class="flex items-center justify-between mb-6 relative z-10">
        <h2 class="text-2xl font-black">Report</h2>
        <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </div>
    </div>
    
    <div class="space-y-4 relative z-10">
        @forelse($reports as $report)
            <div class="bg-white/10 backdrop-blur-md rounded-xl p-4 hover:bg-white/20 transition-all duration-300 cursor-pointer group/item border border-white/20 hover:border-white/40 hover:scale-[1.02]">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h3 class="font-black text-lg mb-1 group-hover/item:text-yellow-200 transition-colors">{{ $report['title'] ?? 'Report Title' }}</h3>
                        <p class="text-sm text-white/80">{{ $report['description'] ?? 'Shared with team' }}</p>
                    </div>
                    <svg class="w-5 h-5 group-hover/item:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
                <div class="flex items-center gap-3 mt-3">
                    @if(isset($report['users']))
                        <div class="flex -space-x-2">
                            @foreach($report['users'] as $user)
                                <img src="{{ $user }}" class="w-8 h-8 rounded-full border-2 border-white shadow-md" alt="User">
                            @endforeach
                        </div>
                    @endif
                    @if(isset($report['badges']))
                        @foreach($report['badges'] as $badge)
                            <span class="px-3 py-1 {{ $badge['bg'] ?? 'bg-green-500' }} text-white text-xs font-black rounded-full shadow-md">
                                {{ $badge['text'] }}
                            </span>
                        @endforeach
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white/10 backdrop-blur-md rounded-xl p-4 hover:bg-white/20 transition-all duration-300 cursor-pointer group/item border border-white/20 hover:border-white/40">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h3 class="font-black text-lg mb-1">Report, 15 Oct</h3>
                        <p class="text-sm text-white/80">Shared with CFO</p>
                    </div>
                    <svg class="w-5 h-5 group-hover/item:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
                <div class="flex items-center gap-3 mt-3">
                    <div class="flex -space-x-2">
                        <img src="https://ui-avatars.com/api/?name=User1&size=32" class="w-8 h-8 rounded-full border-2 border-white shadow-md" alt="User">
                        <img src="https://ui-avatars.com/api/?name=User2&size=32" class="w-8 h-8 rounded-full border-2 border-white shadow-md" alt="User">
                    </div>
                    <div class="flex items-center gap-2 bg-white/20 px-2 py-1 rounded-full">
                        <span class="text-xs font-black">2</span>
                    </div>
                    <span class="px-3 py-1 bg-green-500 text-white text-xs font-black rounded-full shadow-md">in progress</span>
                </div>
            </div>
            <div class="bg-white/10 backdrop-blur-md rounded-xl p-4 hover:bg-white/20 transition-all duration-300 cursor-pointer group/item border border-white/20 hover:border-white/40">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h3 class="font-black text-lg mb-1">Report, 10 Sep</h3>
                        <p class="text-sm text-white/80">Shared with Investors</p>
                    </div>
                    <svg class="w-5 h-5 group-hover/item:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
                <div class="flex items-center gap-3 mt-3">
                    <div class="flex -space-x-2">
                        <img src="https://ui-avatars.com/api/?name=User3&size=32" class="w-8 h-8 rounded-full border-2 border-white shadow-md" alt="User">
                        <img src="https://ui-avatars.com/api/?name=User4&size=32" class="w-8 h-8 rounded-full border-2 border-white shadow-md" alt="User">
                    </div>
                    <span class="px-3 py-1 bg-white/20 text-white text-xs font-black rounded-full shadow-md">Realistic</span>
                    <span class="px-3 py-1 bg-green-500 text-white text-xs font-black rounded-full shadow-md">Complete</span>
                </div>
            </div>
        @endforelse
    </div>
</div>

