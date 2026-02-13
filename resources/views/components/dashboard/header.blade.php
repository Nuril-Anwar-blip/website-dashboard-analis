<div class="h-20 bg-gray-900 flex items-center justify-between px-8 z-10 border-b border-gray-800 shadow-lg">
    <div class="flex items-center gap-6">
        <h1 class="text-2xl font-black text-white">AnalisaPro</h1>
        <div class="flex items-center gap-2 px-4 py-2 bg-gray-800 rounded-lg text-sm text-gray-300 cursor-pointer hover:bg-gray-700 transition-all group">
            <span>{{ now()->format('M Y') }}</span>
            <svg class="w-4 h-4 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
        <button class="px-4 py-2 bg-gray-800 rounded-lg text-sm text-gray-300 hover:bg-gray-700 transition-all flex items-center gap-2 group">
            <span>Edit View</span>
            <svg class="w-4 h-4 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
    </div>

    <div class="flex items-center gap-6">
        <div class="relative w-96">
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>
            <input type="text" placeholder="Ask a question to start the conversation" class="block w-full pl-12 pr-4 py-2.5 border-none rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:bg-gray-750 transition-all sm:text-sm">
        </div>

        <button class="relative p-2.5 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-all group">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-gray-900 animate-pulse"></span>
        </button>

        <div class="flex items-center gap-3">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=4F46E5&color=fff&size=40" class="w-10 h-10 rounded-lg object-cover shadow-md hover:scale-110 transition-transform cursor-pointer">
        </div>

        <button class="px-4 py-2 bg-gray-800 text-gray-300 rounded-lg text-sm font-semibold hover:bg-gray-700 transition-all hover:scale-105">
            Refresh
        </button>
    </div>
</div>

