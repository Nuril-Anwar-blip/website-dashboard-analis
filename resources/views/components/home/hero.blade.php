{{-- 
    Komponen hero utama landing page.
    - Kiri: judul besar, deskripsi singkat produk, CTA "Get Started Free" dan "Sign In".
    - Kanan: ilustrasi kartu-kartu statistik (orders, users, subscriptions, revenue).
    - Juga menyertakan background pattern animasi halus melalui kelas .hero-pattern.
--}}
<section class="relative pt-32 pb-20 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-gradient-to-br from-purple-50 via-indigo-50 to-blue-50"></div>
    <div class="absolute inset-0 hero-pattern opacity-10"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-purple-100 rounded-full text-sm font-semibold text-purple-700 mb-6">
                    <span class="w-2 h-2 bg-purple-500 rounded-full animate-pulse"></span>
                    <span>Analytics Dashboard Platform</span>
                </div>
                
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black text-gray-900 mb-6 leading-tight">
                    Powerful
                    <span class="bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">Analytics</span>
                    <br>for Your Business
                </h1>
                
                <p class="text-xl text-gray-600 mb-8 font-medium leading-relaxed">
                    Transform your data into actionable insights. Track orders, users, subscriptions, and sales with our comprehensive analytics dashboard.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <button onclick="showRegister()" class="px-8 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-bold text-lg hover:from-purple-700 hover:to-indigo-700 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                        Get Started Free
                    </button>
                    <button onclick="showLogin()" class="px-8 py-4 bg-white text-gray-900 rounded-xl font-bold text-lg border-2 border-gray-200 hover:border-purple-300 transition-all shadow-lg hover:shadow-xl">
                        Sign In
                    </button>
                </div>
            </div>
            
            <!-- Right Illustration -->
            <div class="relative">
                <div class="relative bg-white rounded-3xl shadow-2xl p-8 transform hover:scale-105 transition-transform duration-300">
                    <div class="bg-gradient-to-br from-purple-100 to-indigo-100 rounded-2xl p-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white rounded-xl p-4 shadow-lg">
                                <div class="text-2xl font-black text-gray-900 mb-1">201</div>
                                <div class="text-sm text-gray-600 font-semibold">Orders</div>
                                <div class="text-xs text-green-600 font-bold mt-1">↑8.2%</div>
                            </div>
                            <div class="bg-white rounded-xl p-4 shadow-lg">
                                <div class="text-2xl font-black text-gray-900 mb-1">4.890</div>
                                <div class="text-sm text-gray-600 font-semibold">Users</div>
                                <div class="text-xs text-blue-600 font-bold mt-1">Active</div>
                            </div>
                            <div class="bg-white rounded-xl p-4 shadow-lg">
                                <div class="text-2xl font-black text-gray-900 mb-1">1.201</div>
                                <div class="text-sm text-gray-600 font-semibold">Subscriptions</div>
                                <div class="text-xs text-purple-600 font-bold mt-1">Growing</div>
                            </div>
                            <div class="bg-white rounded-xl p-4 shadow-lg">
                                <div class="text-2xl font-black text-gray-900 mb-1">$25K</div>
                                <div class="text-sm text-gray-600 font-semibold">Revenue</div>
                                <div class="text-xs text-green-600 font-bold mt-1">↑12%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.hero-pattern {
    background-image: radial-gradient(circle, #9333EA 1.5px, transparent 1.5px);
    background-size: 40px 40px;
    animation: pattern-move 20s linear infinite;
}
@keyframes pattern-move {
    0% { background-position: 0 0; }
    100% { background-position: 40px 40px; }
}
</style>

