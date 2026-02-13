{{-- 
    =============================================
    HALAMAN BUAT SURVEY BARU
    =============================================
    
    Deskripsi:
    Halaman form untuk membuat survey baru. User dapat mengisi judul dan deskripsi survey.
    
    Fitur:
    - Form input judul survey (wajib)
    - Form textarea deskripsi survey (opsional)
    - Tombol Cancel untuk kembali ke daftar survey
    - Tombol Create Survey untuk menyimpan survey baru
    - Validasi form dengan required attribute
    
    Responsivitas:
    - Mobile: Form full width dengan padding yang disesuaikan
    - Desktop: Form dengan max-width untuk readability yang lebih baik
    - Input dan textarea responsif dengan ukuran font yang menyesuaikan
    - Tombol aksi stack di mobile, inline di desktop
--}}
<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-6 sm:py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-lg border border-gray-200 p-6 sm:p-8">
                {{-- Header --}}
                <div class="mb-6 sm:mb-8">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Buat Survey Baru</h2>
                    <p class="text-sm sm:text-base text-gray-600">Isi informasi dasar untuk survey Anda</p>
                </div>

                {{-- Form --}}
                <form action="{{ route('surveys.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    {{-- Input Judul Survey --}}
                    <div>
                        <label for="title" class="block text-sm sm:text-base font-semibold text-gray-700 mb-2">
                            Judul Survey <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               value="{{ old('title') }}"
                               class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all text-sm sm:text-base" 
                               placeholder="Contoh: Survei Kepuasan Pelanggan 2024" 
                               required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Textarea Deskripsi --}}
                    <div>
                        <label for="description" class="block text-sm sm:text-base font-semibold text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="4" 
                                  class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all text-sm sm:text-base resize-none" 
                                  placeholder="Jelaskan tujuan dan ruang lingkup survey ini...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol Aksi - Stack di mobile, inline di desktop --}}
                    <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-3 pt-4">
                        <a href="{{ route('surveys.index') }}" 
                           class="flex-1 sm:flex-initial text-center text-gray-600 hover:text-gray-900 px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-semibold transition border-2 border-gray-300 hover:border-gray-400">
                            Batal
                        </a>
                        <button type="submit" 
                                class="flex-1 sm:flex-initial bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 sm:py-3 px-4 sm:px-8 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                            Buat Survey
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
