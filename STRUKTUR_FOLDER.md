# Struktur Folder Proyek: Web Dashboard Survey Analytics

Dokumen ini menjelaskan struktur folder dan fungsi dari masing-masing direktori dalam proyek ini untuk mempermudah pengembangan dan pemeliharaan.

## Ringkasan Struktur Root
```text
.
├── app/                # Logika inti aplikasi (Models, Controllers, Services)
├── bootstrap/          # File inisialisasi framework Laravel
├── config/             # Konfigurasi aplikasi (Database, Auth, App)
├── database/           # Migrasi, Seeder, dan Factory database
├── public/             # Asset publik (Entry point index.php, Images, CSS/JS terkompilasi)
├── resources/          # Resource mentah (Blade views, CSS, JavaScript)
├── routes/             # Definisi routing aplikasi (Web, Console)
├── storage/            # File cache, logs, dan file yang diunggah
├── tests/              # Automated tests (Feature & Unit)
├── vendor/             # Dependensi PHP (Composer)
└── node_modules/       # Dependensi JavaScript (NPM)
```

---

## Penjelasan Detail Folder

### 1. `app/`
Folder ini berisi kode inti dari aplikasi.
- **`Http/Controllers/`**: Menangani logika request-response.
    - `Auth/`: Logika autentikasi.
    - `SurveyController.php`: Manajemen data survey.
    - `DashboardController.php`: Logika untuk tampilan dashboard utama.
- **`Models/`**: Representasi tabel database sebagai objek PHP.
    - `Survey.php`, `Question.php`, `Response.php`, `Segment.php`.
- **`Services/`**: Logika bisnis tambahan (seperti `AnalyticsService` untuk kalkulasi KPI).
- **`Imports/`**: Logika untuk mengimpor data (misal: dari Excel/CSV).
- **`Providers/`**: Service providers untuk mendaftarkan layanan ke framework.

### 2. `resources/`
Berisi file-file yang akan dirender atau dikompilasi.
- **`views/`**: Template tampilan menggunakan engine Blade.
    - `auth/`: Halaman login, register, dll.
    - `components/`: Komponen UI yang dapat digunakan kembali (reuseable).
    - `layouts/`: Master template (seperti `app.blade.php`).
    - `surveys/`: Halaman manajemen dan detail survey.
    - `dashboard.blade.php`: Halaman utama statistik.
- **`css/`** & **`js/`**: File stylesheet dan script JavaScript mentah sebelum dikompilasi oleh Vite.

### 3. `database/`
Segala hal yang berkaitan dengan struktur data.
- **`migrations/`**: Skrip untuk membuat dan mengubah tabel database secara terstruktur.
- **`seeders/`**: Data awal/sampel untuk mengisi database (Isi awal untuk testing).
- **`factories/`**: Blueprint untuk menghasilkan data palsu dalam jumlah banyak.
- **`database.sqlite`**: File database lokal (jika menggunakan SQLite).

### 4. `routes/`
Tempat mendaftarkan URL aplikasi.
- **`web.php`**: Route yang diakses melalui browser (memiliki middleware session, CSRF).
- **`console.php`**: Perintah artisan berbasis CLI (Command Line Interface).

### 5. `config/`
Berisi file konfigurasi PHP untuk berbagai komponen aplikasi seperti database, sistem file, cache, dan autentikasi.

### 6. `public/`
Folder satu-satunya yang dapat diakses langsung dari web server. Berisi file statis yang sudah siap pakai.

---

## File Penting di Root
- `.env`: Konfigurasi lingkungan (koneksi database, API keys). **CRITICAL: Jangan hapus file ini.**
- `composer.json`: Daftar library PHP yang dibutuhkan.
- `package.json`: Daftar library JavaScript yang dibutuhkan.
- `artisan`: Tool command-line Laravel untuk berbagai tugas (migrate, serve, dll).
- `vite.config.js`: Konfigurasi untuk compiler asset Vite.
- `DOKUMENTASI.md`: Panduan umum sistem.

---
Dokumen ini dibuat otomatis untuk membantu pemahaman struktur proyek.
