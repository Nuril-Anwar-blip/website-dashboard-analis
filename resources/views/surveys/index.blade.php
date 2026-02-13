{{-- 
    =============================================
    HALAMAN DAFTAR SURVEY
    =============================================
    
    Deskripsi:
    Halaman ini menampilkan daftar semua survey yang telah dibuat oleh user.
    Setiap card survey menampilkan judul, deskripsi, jumlah responden, dan tombol aksi.
    
    Fitur:
    - Tombol "Create New Survey" untuk membuat survey baru
    - Grid card survey dengan informasi lengkap
    - Tombol "View Details" untuk melihat detail survey
    - Tombol "Analytics" untuk melihat dashboard analisis
    - Pesan jika belum ada survey
    
    Responsivitas:
    - Mobile (< 768px): Grid 1 kolom, tombol full width
    - Tablet (768px - 1024px): Grid 2 kolom
    - Desktop (> 1024px): Grid 3 kolom
    - Padding dan spacing menyesuaikan ukuran layar
--}}
<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-gray-200 p-4 sm:p-6 lg:p-8">
                {{-- Header dengan tombol create --}}
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900">Daftar Survey</h3>
                    <a href="{{ route('surveys.create') }}" 
                       class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 sm:px-6 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Buat Survey Baru
                    </a>
                </div>

                {{-- Grid Survey Cards - Responsif: 1 kolom mobile, 2 kolom tablet, 3 kolom desktop --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    @foreach($surveys as $survey)
                        <div class="bg-gradient-to-br from-gray-50 to-indigo-50 p-4 sm:p-6 rounded-xl border-2 border-gray-200 hover:border-indigo-300 hover:shadow-lg transition-all duration-300">
                            <h4 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 line-clamp-2">{{ $survey->title }}</h4>
                            <p class="text-sm sm:text-base text-gray-600 mb-4 line-clamp-3">{{ Str::limit($survey->description ?? 'Tidak ada deskripsi', 100) }}</p>
                            
                            {{-- Info Responden --}}
                            <div class="flex items-center text-xs sm:text-sm text-gray-500 mb-4 sm:mb-6">
                                <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span>{{ $survey->responses_count ?? 0 }} Responden</span>
                            </div>

                            {{-- Tombol Aksi - Responsif dengan flex column di mobile --}}
                            <div class="flex flex-col sm:flex-row gap-2">
                                <a href="{{ route('surveys.show', $survey) }}" 
                                   class="flex-1 text-center bg-white hover:bg-gray-100 text-gray-900 border-2 border-gray-300 py-2 px-4 rounded-lg font-semibold transition text-sm sm:text-base">
                                    Detail
                                </a>
                                <a href="{{ route('dashboard', ['survey' => $survey->id]) }}" 
                                   class="flex-1 text-center bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg font-semibold transition text-sm sm:text-base">
                                    Analytics
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pesan jika belum ada survey --}}
                @if($surveys->isEmpty())
                    <div class="text-center py-12 sm:py-16">
                        <svg class="w-16 h-16 sm:w-20 sm:h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="text-gray-500 text-base sm:text-lg mb-4">Belum ada survey. Mulai dengan membuat survey baru!</p>
                        <a href="{{ route('surveys.create') }}" 
                           class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                            Buat Survey Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
