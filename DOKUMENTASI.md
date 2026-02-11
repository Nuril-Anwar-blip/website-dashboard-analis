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
