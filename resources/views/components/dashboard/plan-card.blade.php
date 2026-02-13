@props(['activeTab' => 'optimistic'])

<div class="bg-gradient-to-br from-yellow-400 via-yellow-500 to-yellow-400 rounded-2xl p-6 shadow-2xl border-2 border-yellow-300 hover:border-yellow-400 transition-all duration-300 group">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-black text-gray-900">Plan</h2>
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2 bg-white/60 backdrop-blur-sm rounded-lg px-1 py-1 shadow-lg">
                <button class="text-sm font-black text-gray-900 px-3 py-1.5 bg-white rounded-md shadow-sm transition-all {{ $activeTab === 'optimistic' ? 'scale-105' : '' }}" onclick="switchTab('optimistic')">
                    Optimistic
                </button>
                <button class="text-sm font-semibold text-gray-700 px-3 py-1.5 hover:bg-white/50 rounded-md transition-all {{ $activeTab === 'realistic' ? 'bg-white scale-105' : '' }}" onclick="switchTab('realistic')">
                    Realistic
                </button>
            </div>
            <button class="bg-gray-900 text-white px-5 py-2.5 rounded-lg font-black text-sm flex items-center gap-2 hover:bg-gray-800 transition-all shadow-lg hover:scale-105">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Analyze
            </button>
        </div>
    </div>
    
    <!-- Chart Container -->
    <div class="bg-white rounded-xl p-6 shadow-xl border-2 border-gray-100">
        <div class="h-64">
            <canvas id="planChart"></canvas>
        </div>
    </div>
</div>

<script>
function switchTab(tab) {
    // Update active tab styling
    document.querySelectorAll('[onclick*="switchTab"]').forEach(btn => {
        btn.classList.remove('bg-white', 'scale-105', 'font-black');
        btn.classList.add('font-semibold');
    });
    event.target.classList.add('bg-white', 'scale-105', 'font-black');
    event.target.classList.remove('font-semibold');
    
    // Here you can add logic to update chart data based on tab
    console.log('Switched to:', tab);
}
</script>

