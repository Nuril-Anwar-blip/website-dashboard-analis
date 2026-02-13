{{-- 
    Komponen footer untuk halaman publik.
    - Menampilkan brand singkat + deskripsi produk.
    - Tiga kolom link: Product, Company, dan Legal.
    - Di bagian bawah terdapat copyright sederhana.
--}}
<footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand -->
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-xl flex items-center justify-center text-white font-black text-xl">
                        X
                    </div>
                    <span class="text-2xl font-black">Business</span>
                </div>
                <p class="text-gray-400 font-medium leading-relaxed">Powerful analytics dashboard for your business. Transform data into insights.</p>
            </div>
            
            <!-- Links -->
            <div>
                <h3 class="font-black text-lg mb-4">Product</h3>
                <ul class="space-y-2">
                    <li><a href="#features" class="text-gray-400 hover:text-white font-semibold transition-colors">Features</a></li>
                    <li><a href="#pricing" class="text-gray-400 hover:text-white font-semibold transition-colors">Pricing</a></li>
                    <li><a href="#about" class="text-gray-400 hover:text-white font-semibold transition-colors">About</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="font-black text-lg mb-4">Company</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white font-semibold transition-colors">Blog</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white font-semibold transition-colors">Careers</a></li>
                    <li><a href="#contact" class="text-gray-400 hover:text-white font-semibold transition-colors">Contact</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="font-black text-lg mb-4">Legal</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white font-semibold transition-colors">Privacy</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white font-semibold transition-colors">Terms</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white font-semibold transition-colors">Security</a></li>
                </ul>
            </div>
        </div>
        
        <div class="mt-8 pt-8 border-t border-gray-800 text-center">
            <p class="text-gray-400 font-semibold">&copy; 2024 Business Analytics. All rights reserved.</p>
        </div>
    </div>
</footer>

