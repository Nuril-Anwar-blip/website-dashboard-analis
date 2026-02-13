# Dokumentasi Sistem: Web Dashboard Survey Analytics

## Gambaran Umum
Sistem ini adalah platform analitik survey berbasis Laravel 12 yang dirancang untuk mengolah data secara otomatis dan memberikan wawasan visual serta laporan mendalam.

## Arsitektur Sistem
Sistem menggunakan **Three-Tier Architecture**:
1.  **Presentation Layer**: Menggunakan Blade Templating dan Chart.js untuk visualisasi.
2.  **Application Layer**: Laravel 12 Backend dengan layanan khusus untuk analitik (`AnalyticsService`).
3.  **Data Layer**: Database relasional (SQLite/MySQL) untuk penyimpanan data terstruktur.

## Fitur Utama
- **Autentikasi Multi-Role**: Admin, Enumerator, dan Analyst.
- **Impor Data Cerdas**: Mendukung file Excel/CSV melalui Maatwebsite Excel.
- **Mesin KPI Otomatis**: Menghitung Net Promoter Score (NPS) dan Indeks Kepuasan secara otomatis.
- **Dashboard Visual**: Grafik interaktif yang dapat difilter berdasarkan survey.
- **Laporan PDF**: Generasi laporan instan menggunakan DomPDF.

## Keterbatasan & Hal yang Perlu Dikembangkan

1. **Input & Excel**
   - Integrasi langsung ke sumber data eksternal (misalnya Google Sheets / API survey pihak ketiga) belum tersedia, sehingga proses **unggah masih manual** menggunakan file Excel/CSV.
   - Template Excel harus mengikuti struktur kolom tertentu; perubahan struktur membutuhkan penyesuaian atau mapping ulang sebelum impor.
   - Validasi kualitas data di sisi file masih terbatas, sehingga data kotor (format tanggal tidak konsisten, angka dalam bentuk teks, nilai kosong) baru dibersihkan di dalam aplikasi.

2. **Proses Pengolahan Data**
   - Proses cleaning, agregasi, dan analitik berjalan secara **batch**; sistem belum dirancang untuk skenario streaming data real-time.
   - Belum ada manajemen versi data (data versioning) yang eksplisit; ketika ada revisi data survey, proses impor dan perhitungan ulang masih dilakukan manual.
   - Analitik lanjutan (misalnya modelling statistik kompleks atau machine learning) belum terintegrasi; fokus masih pada agregasi, segmentasi dasar, dan KPI standar.

3. **Dashboard & Output**
   - Opsi **kustomisasi tampilan dashboard oleh pengguna akhir masih terbatas** (belum ada drag-and-drop widget atau layout builder).
   - Template laporan PDF/Excel masih statis; perubahan susunan atau gaya laporan membutuhkan perubahan kode Blade/Laravel.
   - Belum ada dukungan penuh **multi-bahasa** di seluruh elemen dashboard dan laporan.

4. **Arsitektur & Skalabilitas**
   - Aplikasi masih berbentuk monolit Laravel; untuk beban data yang sangat besar diperlukan konfigurasi tambahan di sisi database (indexing, sharding) dan caching.
   - Fitur multi-tenant (satu instance digunakan banyak organisasi dengan isolasi data penuh) belum diimplementasikan secara penuh.
   - Monitoring performa dan logging masih dasar; integrasi dengan sistem observability (Grafana/Prometheus/Sentry dsb.) merupakan ruang pengembangan berikutnya.

5. **Keamanan & Manajemen Akses**
   - Skema role pengguna masih sederhana; kontrol akses granular per fitur atau per-survey dapat dikembangkan lebih lanjut.
   - Single Sign-On (SSO) seperti Google Workspace, Azure AD, atau LDAP belum tersedia; saat ini pengguna menggunakan akun lokal aplikasi.

## Cara Instalasi
1. Clone repositori.
2. Jalankan `composer install`.
3. Jalankan `npm install && npm run build`.
4. Salin `.env.example` ke `.env` dan atur database.
5. Jalankan `php artisan key:generate`.
6. Jalankan `php artisan migrate --seed` (Gunakan akun `admin@survey.com` / `password`).
7. Jalankan `php artisan serve`.

## Struktur Database
- `surveys`: Menyimpan metadata survey.
- `questions`: Daftar pertanyaan per survey.
- `responses`: Catatan identitas responden.
- `response_details`: Jawaban detail per pertanyaan.
- `kpi_results`: Hasil kalkulasi analitik berkala.

---
Dokumentasi ini dibuat untuk membantu pengembangan dan pemeliharaan sistem di masa mendatang.
