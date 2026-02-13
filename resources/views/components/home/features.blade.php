{{-- 
    Komponen daftar fitur utama produk.
    - Terbagi menjadi beberapa kartu feature dengan ikon, judul, dan deskripsi.
    - Mencakup aspek real-time analytics, manajemen user, order tracking, keamanan,
      kustomisasi dashboard, dan dukungan light/dark mode.
    - Dipanggil di landing page melalui <x-home.features />.
--}}
<section id="features" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl sm:text-5xl font-black text-gray-900 mb-4">
                Powerful <span class="bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">Features</span>
            </h2>
            <p class="text-xl text-gray-600 font-medium">Everything you need to analyze your business data</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-2xl p-8 hover:shadow-xl transition-all transform hover:-translate-y-2">
                <div class="w-14 h-14 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-3">Real-time Analytics</h3>
                <p class="text-gray-600 font-medium leading-relaxed">Track your business metrics in real-time with beautiful charts and visualizations.</p>
            </div>
            
            <!-- Feature 2 -->
            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl p-8 hover:shadow-xl transition-all transform hover:-translate-y-2">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-cyan-600 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-3">User Management</h3>
                <p class="text-gray-600 font-medium leading-relaxed">Manage users, subscriptions, and track user activity with detailed insights.</p>
            </div>
            
            <!-- Feature 3 -->
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-8 hover:shadow-xl transition-all transform hover:-translate-y-2">
                <div class="w-14 h-14 bg-gradient-to-br from-green-600 to-emerald-600 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-3">Order Tracking</h3>
                <p class="text-gray-600 font-medium leading-relaxed">Monitor orders, revenue, and sales dynamics with comprehensive reporting.</p>
            </div>
            
            <!-- Feature 4 -->
            <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-2xl p-8 hover:shadow-xl transition-all transform hover:-translate-y-2">
                <div class="w-14 h-14 bg-gradient-to-br from-orange-600 to-amber-600 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-3">Customizable Dashboard</h3>
                <p class="text-gray-600 font-medium leading-relaxed">Customize your dashboard with drag-and-drop widgets and personalized views.</p>
            </div>
            
            <!-- Feature 5 -->
            <div class="bg-gradient-to-br from-pink-50 to-rose-50 rounded-2xl p-8 hover:shadow-xl transition-all transform hover:-translate-y-2">
                <div class="w-14 h-14 bg-gradient-to-br from-pink-600 to-rose-600 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-3">Secure & Private</h3>
                <p class="text-gray-600 font-medium leading-relaxed">Enterprise-grade security to keep your data safe and private.</p>
            </div>
            
            <!-- Feature 6 -->
            <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-8 hover:shadow-xl transition-all transform hover:-translate-y-2">
                <div class="w-14 h-14 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-3">Light & Dark Mode</h3>
                <p class="text-gray-600 font-medium leading-relaxed">Switch between light and dark themes for comfortable viewing anytime.</p>
            </div>
        </div>
    </div>
</section>

