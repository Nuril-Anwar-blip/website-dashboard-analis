{{-- 
    =============================================
    HALAMAN DETAIL SURVEY
    =============================================
    
    Menampilkan:
    - Informasi survey (judul, deskripsi)
    - Daftar pertanyaan
    - Form upload Excel/CSV yang jelas dan menarik
    - Form input manual data survey
    - Statistik survey
    - Tombol export PDF
--}}
<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Alert Messages - Menampilkan pesan sukses/error dengan format multi-line --}}
            @if(session('success'))
                <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-300 text-green-900 px-4 sm:px-6 py-4 sm:py-5 rounded-xl shadow-lg">
                    <div class="flex items-start gap-3 sm:gap-4">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-base sm:text-lg mb-2 text-green-800">Import Berhasil!</h3>
                            <div class="text-sm sm:text-base whitespace-pre-line leading-relaxed">{{ session('success') }}</div>
                            @if(session('imported_count'))
                                <div class="mt-3 pt-3 border-t border-green-200">
                                    <div class="flex items-center gap-2 text-xs sm:text-sm text-green-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span><strong>{{ session('imported_count') }}</strong> data baru ditambahkan</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 text-green-600 hover:text-green-800 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-gradient-to-r from-red-50 to-pink-50 border-2 border-red-300 text-red-900 px-4 sm:px-6 py-4 sm:py-5 rounded-xl shadow-lg">
                    <div class="flex items-start gap-3 sm:gap-4">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-base sm:text-lg mb-2 text-red-800">Import Gagal!</h3>
                            <div class="text-sm sm:text-base whitespace-pre-line leading-relaxed">{{ session('error') }}</div>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 text-red-600 hover:text-red-800 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            {{-- Header Section - Responsif dengan tombol yang menyesuaikan --}}
            <div class="mb-6 sm:mb-8">
                <div class="flex flex-col gap-4 mb-4 sm:mb-6">
                    <div>
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-gray-900 mb-2">{{ $survey->title }}</h1>
                        <p class="text-sm sm:text-base text-gray-600 font-medium">{{ $survey->description ?? 'Tidak ada deskripsi' }}</p>
                    </div>
                    <div class="flex flex-col sm:flex-row flex-wrap gap-2 sm:gap-3">
                        <a href="{{ route('surveys.index') }}" 
                           class="flex-1 sm:flex-initial px-4 sm:px-6 py-2.5 sm:py-3 bg-white border-2 border-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-all shadow-sm flex items-center justify-center gap-2 text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali
                        </a>
                        <a href="{{ route('dashboard', ['survey' => $survey->id]) }}" 
                           class="flex-1 sm:flex-initial px-4 sm:px-6 py-2.5 sm:py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-bold hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg flex items-center justify-center gap-2 text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <span class="hidden sm:inline">Lihat </span>Dashboard
                        </a>
                        <a href="{{ route('surveys.export', $survey) }}" 
                           class="flex-1 sm:flex-initial px-4 sm:px-6 py-2.5 sm:py-3 bg-gradient-to-r from-red-600 to-pink-600 text-white rounded-xl font-bold hover:from-red-700 hover:to-pink-700 transition-all shadow-lg flex items-center justify-center gap-2 text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export PDF
                        </a>
                    </div>
                </div>
            </div>

            {{-- Main Content Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Left: Survey Info, Questions & Manual Input --}}
                <div class="lg:col-span-2 space-y-6">
                    {{-- Survey Description Card - Responsif --}}
                    <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 lg:p-8 shadow-lg border border-gray-100">
                        <div class="flex items-center gap-3 sm:gap-4 mb-4 sm:mb-6">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Deskripsi Survei</h2>
                        </div>
                        <p class="text-sm sm:text-base lg:text-lg text-gray-700 leading-relaxed">{{ $survey->description ?? 'Tidak ada deskripsi yang tersedia untuk survei ini.' }}</p>
                    </div>

                    {{-- Questions List Card - Responsif --}}
                    <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 lg:p-8 shadow-lg border border-gray-100">
                        <div class="flex items-center justify-between mb-4 sm:mb-6">
                            <div class="flex items-center gap-3 sm:gap-4">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-amber-400 to-orange-500 rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Pertanyaan ({{ $survey->questions->count() }})</h2>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            @foreach($survey->questions as $index => $question)
                                <div class="p-4 sm:p-6 bg-gradient-to-r from-indigo-50 via-purple-50 to-pink-50 rounded-lg sm:rounded-xl border-2 border-indigo-100 hover:border-indigo-300 transition-all group">
                                    <div class="flex items-start gap-3 sm:gap-4">
                                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-base sm:text-lg flex-shrink-0 shadow-md">
                                            {{ $index + 1 }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 sm:gap-3 mb-2 sm:mb-3">
                                                <span class="px-2 sm:px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-bold rounded-lg uppercase tracking-wide">
                                                    {{ $question->question_type }}
                                                </span>
                                            </div>
                                            <p class="text-sm sm:text-base lg:text-lg text-gray-900 font-semibold leading-relaxed break-words">{{ $question->question_text }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            @if($survey->questions->isEmpty())
                                <div class="p-12 text-center bg-gray-50 rounded-xl border-2 border-dashed border-gray-300">
                                    <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-gray-500 font-semibold text-lg">Belum ada pertanyaan yang ditambahkan</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Manual Input Form Card --}}
                    @if($survey->questions->count() > 0)
                    <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Input Data Manual</h2>
                        </div>
                        
                        <form action="{{ route('surveys.response.store', $survey) }}" method="POST" class="space-y-6">
                            @csrf
                            
                            {{-- Region & Segment --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Region (Opsional)</label>
                                    <input type="text" name="region" value="{{ old('region') }}" 
                                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                                           placeholder="Contoh: Jakarta, Bandung, dll">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Segment (Opsional)</label>
                                    <input type="text" name="segment" value="{{ old('segment') }}" 
                                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                                           placeholder="Contoh: General, Premium, dll">
                                </div>
                            </div>

                            {{-- Questions Input --}}
                            <div class="space-y-4">
                                <h3 class="text-lg font-bold text-gray-900 mb-4">Jawaban Pertanyaan</h3>
                                @foreach($survey->questions as $question)
                                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-200">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            {{ $question->question_text }}
                                            <span class="text-xs text-gray-500 ml-2">({{ $question->question_type }})</span>
                                        </label>
                                        @if($question->question_type === 'scale')
                                            <input type="number" 
                                                   name="question_{{ $question->id }}" 
                                                   value="{{ old('question_' . $question->id) }}"
                                                   min="0" 
                                                   max="10" 
                                                   step="1"
                                                   required
                                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                                                   placeholder="Masukkan nilai 0-10">
                                        @else
                                            <textarea name="question_{{ $question->id }}" 
                                                      rows="3"
                                                      required
                                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                                                      placeholder="Masukkan jawaban">{{ old('question_' . $question->id) }}</textarea>
                                        @endif
                                        @error('question_' . $question->id)
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 rounded-xl font-bold text-base hover:from-indigo-700 hover:to-purple-700 transition-all transform hover:-translate-y-0.5 shadow-xl flex items-center justify-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Simpan Data Respons
                            </button>
                        </form>
                    </div>
                    @endif
                </div>

                {{-- Right: Upload & Stats --}}
                <div class="space-y-6">
                    {{-- Upload Card --}}
                    <div class="bg-gradient-to-br from-green-500 via-emerald-500 to-teal-500 rounded-2xl p-8 shadow-2xl text-white relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold mb-3">Import Data Survey</h3>
                            <p class="text-green-50 text-sm mb-4 leading-relaxed">
                                Upload file Excel (.xlsx, .xls) atau CSV yang berisi data respons survei untuk dianalisis.
                            </p>
                            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3 sm:p-4 mb-4 sm:mb-6 text-xs text-green-50">
                                <p class="font-semibold mb-2">Format File:</p>
                                <ul class="list-disc list-inside space-y-1">
                                    <li>Baris pertama harus berisi header (nama kolom)</li>
                                    <li>Kolom wajib: <strong>Region</strong> dan <strong>Segment</strong> (opsional)</li>
                                    <li>Kolom jawaban: gunakan teks pertanyaan atau Q1, Q2, dll</li>
                                    <li>Maksimal ukuran file: 10MB</li>
                                </ul>
                            </div>
                            
                            <form action="{{ route('surveys.import', $survey) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                <div class="relative">
                                    <input type="file" 
                                           name="file" 
                                           id="fileInput"
                                           accept=".xlsx,.xls,.csv"
                                           class="hidden"
                                           required
                                           onchange="updateFileName(this)">
                                    <label for="fileInput" class="block w-full cursor-pointer">
                                        <div class="bg-white/20 backdrop-blur-sm border-2 border-dashed border-white/40 rounded-lg sm:rounded-xl p-4 sm:p-6 text-center hover:bg-white/30 hover:border-white/60 transition-all group">
                                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white mx-auto mb-2 sm:mb-3 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <p class="text-xs sm:text-sm font-bold text-white mb-1">
                                                Klik untuk upload atau drag & drop
                                            </p>
                                            <p class="text-xs text-green-50" id="fileName">Format: Excel (.xlsx, .xls) atau CSV</p>
                                        </div>
                                    </label>
                                </div>
                                @error('file')
                                    <p class="text-xs sm:text-sm text-red-200">{{ $message }}</p>
                                @enderror
                                <button type="submit" class="w-full bg-white text-green-600 py-3 sm:py-4 rounded-lg sm:rounded-xl font-bold text-sm sm:text-base hover:bg-green-50 transition-all transform hover:-translate-y-0.5 shadow-xl flex items-center justify-center gap-2 sm:gap-3">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                    Upload & Import Data
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Stats Card - Responsif --}}
                    <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 lg:p-8 shadow-lg border border-gray-100">
                        <div class="flex items-center gap-3 sm:gap-4 mb-4 sm:mb-6">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900">Statistik</h3>
                        </div>
                        <div class="space-y-3 sm:space-y-4">
                            <div class="p-4 sm:p-6 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-lg sm:rounded-xl border-2 border-indigo-100" id="totalRespondenCard">
                                <div class="text-3xl sm:text-4xl font-black text-indigo-600 mb-2" id="totalResponden">{{ $survey->responses->count() }}</div>
                                <div class="text-xs sm:text-sm font-bold text-gray-600 uppercase tracking-wider">Total Responden</div>
                            </div>
                            <div class="p-4 sm:p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg sm:rounded-xl border-2 border-green-100">
                                <div class="text-3xl sm:text-4xl font-black text-green-600 mb-2">{{ $survey->questions->count() }}</div>
                                <div class="text-xs sm:text-sm font-bold text-gray-600 uppercase tracking-wider">Total Pertanyaan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        /**
         * Update nama file yang dipilih untuk ditampilkan di UI
         */
        function updateFileName(input) {
            const fileName = input.files[0]?.name || 'Format: Excel (.xlsx, .xls) atau CSV';
            document.getElementById('fileName').textContent = fileName;
        }

        /**
         * Auto-refresh statistik setelah import berhasil
         * Jika ada session success dengan imported_count, refresh halaman setelah 2 detik
         * untuk menampilkan statistik terbaru
         */
        @if(session('success') && session('imported_count'))
            // Refresh statistik setelah 2 detik
            setTimeout(function() {
                // Reload halaman untuk menampilkan statistik terbaru
                window.location.reload();
            }, 2000);
        @endif

        /**
         * Auto-hide alert setelah 10 detik
         */
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('[class*="bg-gradient-to-r"]');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.remove();
                    }, 500);
                }, 10000); // Hide setelah 10 detik
            });
        });
    </script>
</x-app-layout>
