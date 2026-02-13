<x-app-layout>
    <div class="space-y-8">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-black text-[#1B254B] mb-2">{{ $survey->title }}</h1>
                <p class="text-gray-500 font-semibold">{{ $survey->description ?? 'Tidak ada deskripsi' }}</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('surveys.index') }}" class="px-6 py-3 bg-white border-2 border-gray-200 text-[#1B254B] rounded-2xl font-bold hover:bg-gray-50 transition-all shadow-sm">
                    <span class="hidden sm:inline">Kembali ke </span>Daftar
                </a>
                <a href="{{ route('dashboard', ['survey' => $survey->id]) }}" class="px-6 py-3 bg-gradient-to-r from-[#1B254B] to-[#2A355F] text-white rounded-2xl font-black hover:from-[#2A355F] hover:to-[#3B4D8F] transition-all shadow-xl flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                    Lihat Analytics
                </a>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- Left: Survey Info & Questions -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Survey Description -->
                <div class="bg-white rounded-[3rem] p-8 sm:p-10 shadow-xl border-2 border-gray-100">
                    <h3 class="text-2xl font-black text-[#1B254B] mb-4 flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 9 9 9 0 0118 0z" /></svg>
                        </div>
                        Deskripsi Survei
                    </h3>
                    <p class="text-gray-600 font-semibold leading-relaxed">{{ $survey->description ?? 'Tidak ada deskripsi yang tersedia untuk survei ini.' }}</p>
                </div>

                <!-- Questions List -->
                <div class="bg-white rounded-[3rem] p-8 sm:p-10 shadow-xl border-2 border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-black text-[#1B254B] flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-[#FFCB42] to-[#FFD970] rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#1B254B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            Pertanyaan ({{ $survey->questions->count() }})
                        </h3>
                    </div>
                    <div class="space-y-4">
                        @foreach($survey->questions as $index => $question)
                            <div class="p-6 bg-gradient-to-r from-gray-50 to-indigo-50 rounded-3xl border-2 border-gray-100 hover:border-indigo-200 transition-all group">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center text-white font-black text-lg flex-shrink-0">
                                        {{ $index + 1 }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-black rounded-xl uppercase">
                                                {{ $question->question_type }}
                                            </span>
                                        </div>
                                        <p class="text-[#1B254B] font-bold text-base sm:text-lg">{{ $question->question_text }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if($survey->questions->isEmpty())
                            <div class="p-8 text-center bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-gray-500 font-semibold">Belum ada pertanyaan yang ditambahkan</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right: Import Section -->
            <div class="space-y-6">
                <!-- Upload Card -->
                <div class="bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 rounded-[3rem] p-8 shadow-2xl border-2 border-green-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-48 h-48 bg-green-200/20 rounded-full blur-3xl"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-3xl flex items-center justify-center mb-6 shadow-xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-[#1B254B] mb-3">Import Data Survey</h3>
                        <p class="text-sm text-gray-600 font-semibold mb-6 leading-relaxed">
                            Upload file Excel (.xlsx, .xls) atau CSV yang berisi data respons survei
                        </p>
                        
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
                                    <div class="bg-white border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-green-400 hover:bg-green-50 transition-all group">
                                        <svg class="w-12 h-12 text-gray-400 group-hover:text-green-500 mx-auto mb-4 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        <p class="text-sm font-bold text-gray-600 mb-2">
                                            <span class="text-green-600 group-hover:text-green-700">Klik untuk upload</span> atau drag & drop
                                        </p>
                                        <p class="text-xs text-gray-500" id="fileName">Format: Excel (.xlsx, .xls) atau CSV</p>
                                    </div>
                                </label>
                            </div>
                            <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white py-4 rounded-2xl font-black text-base hover:from-green-700 hover:to-emerald-700 transition-all transform hover:-translate-y-1 shadow-xl flex items-center justify-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                                Upload & Import Data
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Stats Card -->
                <div class="bg-white rounded-[3rem] p-8 shadow-xl border-2 border-gray-100">
                    <h3 class="text-xl font-black text-[#1B254B] mb-6 flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20V18c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </div>
                        Statistik
                    </h3>
                    <div class="space-y-4">
                        <div class="p-6 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl border-2 border-indigo-100">
                            <div class="text-4xl font-black text-indigo-600 mb-2">{{ $survey->responses->count() }}</div>
                            <div class="text-sm font-bold text-gray-600 uppercase tracking-wider">Total Responden</div>
                        </div>
                        <div class="p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border-2 border-green-100">
                            <div class="text-4xl font-black text-green-600 mb-2">{{ $survey->questions->count() }}</div>
                            <div class="text-sm font-bold text-gray-600 uppercase tracking-wider">Total Pertanyaan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateFileName(input) {
            const fileName = input.files[0]?.name || 'Format: Excel (.xlsx, .xls) atau CSV';
            document.getElementById('fileName').textContent = fileName;
        }
    </script>
</x-app-layout>
