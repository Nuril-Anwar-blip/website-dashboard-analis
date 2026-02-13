@props(['items' => []])

<div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 shadow-xl border-2 border-gray-200 hover:border-gray-300 transition-all duration-300 hover:shadow-2xl group">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-black text-gray-900">Check</h2>
        <div class="w-10 h-10 bg-green-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>
    
    <div class="mb-6">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-bold text-gray-700">Progress</span>
            <span class="text-sm font-black text-green-600 bg-green-100 px-3 py-1 rounded-full">100% complete</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden shadow-inner">
            <div class="bg-gradient-to-r from-green-500 to-green-600 h-3 rounded-full shadow-lg transition-all duration-1000" style="width: 100%">
                <div class="h-full w-full bg-gradient-to-r from-transparent via-white/30 to-transparent animate-shimmer"></div>
            </div>
        </div>
    </div>
    
    <div class="space-y-3">
        @forelse($items as $item)
            <div class="flex items-center gap-3 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 hover:scale-[1.02] group/item">
                <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover/item:bg-yellow-200 transition-colors">
                    <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex items-center gap-2 flex-1 min-w-0">
                    <span class="text-sm font-semibold text-gray-800 truncate">{{ $item['text'] ?? 'Task item' }}</span>
                    @if(isset($item['avatar']))
                        <img src="{{ $item['avatar'] }}" class="w-6 h-6 rounded-full border-2 border-gray-200 flex-shrink-0" alt="User">
                    @endif
                </div>
            </div>
        @empty
            <div class="flex items-center gap-3 p-4 bg-white rounded-xl shadow-sm">
                <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-800">2 Missing Invoices</span>
            </div>
            <div class="flex items-center gap-3 p-4 bg-white rounded-xl shadow-sm">
                <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex items-center gap-2 flex-1">
                    <span class="text-sm font-medium text-gray-800">9 missing hours in time sheets</span>
                    <img src="https://ui-avatars.com/api/?name=User&size=24" class="w-6 h-6 rounded-full border-2 border-gray-200" alt="User">
                </div>
            </div>
            <div class="flex items-center gap-3 p-4 bg-white rounded-xl shadow-sm">
                <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex items-center gap-2 flex-1">
                    <span class="text-sm font-medium text-gray-800">Unreconciled Accounts Receivable</span>
                    <img src="https://ui-avatars.com/api/?name=User&size=24" class="w-6 h-6 rounded-full border-2 border-gray-200" alt="User">
                </div>
            </div>
        @endforelse
    </div>
</div>

