{{-- 
    Halaman dokumentasi ringkas alur sistem & keterbatasan proyek.
    - Menjelaskan alur: Input data -> Processing -> Output.
    - Menjelaskan kekurangan/keterbatasan saat ini (Excel, proses, dashboard, dll.).
    - Hanya dapat diakses user yang sudah login (route dilindungi auth & verified).
--}}
<x-app-layout>
    <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-6">
            Membantu membuat dashboard survey web Laravel (pengembangan)
        </h1>

        <p class="text-sm sm:text-base text-slate-700 font-semibold mb-4">
            Data mereka input &rarr; sistem mengolah &rarr; tampil menjadi dashboard insight.
        </p>

        <p class="text-sm text-slate-600 mb-6">
            Alurnya:
        </p>

        {{-- 1. Input Data --}}
        <h2 class="text-xl font-semibold text-slate-900 mb-2">1. Input data</h2>
        <ul class="list-disc list-inside text-sm text-slate-700 mb-4 space-y-1">
            <li>Enumerator upload data survey (Excel / CSV / form).</li>
            <li>Atau data masuk otomatis dari sistem survey eksternal (jika sudah diintegrasikan).</li>
        </ul>

        {{-- 2. Processing --}}
        <h2 class="text-xl font-semibold text-slate-900 mb-2">
            2. Processing (Laravel Analytics)
        </h2>
        <ul class="list-disc list-inside text-sm text-slate-700 mb-4 space-y-1">
            <li>Cleaning data (normalisasi format, menghapus duplikasi, menangani nilai kosong).</li>
            <li>Agregasi (menghitung total, rata-rata, persentase per segmentasi).</li>
            <li>Analisis statistik dasar sesuai kebutuhan survey.</li>
            <li>Segmentasi responden (region, segment, kategori lain).</li>
            <li>Perhitungan KPI seperti indeks kepuasan dan skor lainnya.</li>
        </ul>

        {{-- 3. Output --}}
        <h2 class="text-xl font-semibold text-slate-900 mb-2">3. Output</h2>
        <ul class="list-disc list-inside text-sm text-slate-700 mb-8 space-y-1">
            <li>Dashboard visual (chart, tren, segmentasi) di halaman utama.</li>
            <li>Insight report PDF / Excel untuk dibagikan ke stakeholder.</li>
        </ul>

        <hr class="my-8">

        {{-- Keterbatasan / Hal yang Perlu Dikembangkan --}}
        <h2 class="text-2xl font-bold text-slate-900 mb-4">
            Keterbatasan & Pengembangan Lanjutan
        </h2>

        <div class="space-y-6 text-sm text-slate-700">
            <div>
                <h3 class="font-semibold text-slate-900">1. Input & Excel</h3>
                <ul class="list-disc list-inside mt-1 space-y-1">
                    <li>Integrasi langsung ke Google Sheets atau API survey eksternal belum tersedia (upload masih manual Excel/CSV).</li>
                    <li>Template Excel harus mengikuti struktur tertentu; perubahan kolom perlu penyesuaian ulang.</li>
                    <li>Validasi kualitas data di sisi file masih terbatas, sehingga proses cleaning tetap dilakukan di dalam sistem.</li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold text-slate-900">2. Proses Pengolahan Data</h3>
                <ul class="list-disc list-inside mt-1 space-y-1">
                    <li>Proses analitik berjalan batch, belum real-time streaming.</li>
                    <li>Belum ada data versioning yang eksplisit jika ada revisi data survey.</li>
                    <li>Analitik lanjutan (ML / modelling statistik kompleks) belum terintegrasi; fokus masih pada agregasi & KPI dasar.</li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold text-slate-900">3. Dashboard & Laporan</h3>
                <ul class="list-disc list-inside mt-1 space-y-1">
                    <li>Kustomisasi layout dashboard oleh user akhir masih terbatas.</li>
                    <li>Template laporan PDF/Excel statis, perubahan layout membutuhkan perubahan kode.</li>
                    <li>Dukungan multi-bahasa di seluruh antarmuka dan laporan belum penuh.</li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold text-slate-900">4. Arsitektur & Skalabilitas</h3>
                <ul class="list-disc list-inside mt-1 space-y-1">
                    <li>Aplikasi monolit Laravel; skala data sangat besar memerlukan tuning database dan caching tambahan.</li>
                    <li>Multi-tenant (banyak organisasi dalam satu instance) belum diimplementasikan penuh.</li>
                    <li>Monitoring performa & logging masih dasar, belum terintegrasi dengan tool observability eksternal.</li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold text-slate-900">5. Keamanan & Manajemen Akses</h3>
                <ul class="list-disc list-inside mt-1 space-y-1">
                    <li>Role & permission masih sederhana, kontrol granular per survey/fitur bisa dikembangkan lagi.</li>
                    <li>Belum ada integrasi Single Sign-On (SSO) seperti Google Workspace/Azure AD.</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>


