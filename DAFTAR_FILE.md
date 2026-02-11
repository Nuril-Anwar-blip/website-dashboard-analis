# Dokumentasi Detail Per File: Web Dashboard Survey Analytics

Dokumen ini memberikan penjelasan lengkap untuk **setiap file** yang ada dalam proyek ini, dikategorikan berdasarkan struktur foldernya.

---

## 📂 Folder `app/` (Logika Aplikasi)

### 📁 `app/Models/` (Entitas Data)
- **`User.php`**: Mengelola data pengguna, autentikasi, dan hak akses.
- **`Survey.php`**: Definisi tabel survey (judul, deskripsi, status aktif).
- **`Question.php`**: Definisi pertanyaan (teks pertanyaan, tipe jawaban).
- **`Response.php`**: Metadata pengisian survey (siapa yang mengisi, kapan, dari mana).
- **`ResponseDetail.php`**: Jawaban spesifik untuk setiap pertanyaan yang diberikan responden.
- **`Segment.php`**: Klasifikasi responden untuk keperluan analisis demografi.
- **`Region.php`**: Data wilayah/area responden.
- **`KpiResult.php`**: Penyimpanan hasil perhitungan KPI (NPS, CSAT) secara permanen.
- **`AnalyticsCache.php`**: Menyimpan hasil olahan data sementara untuk mempercepat performa dashboard.

### 📁 `app/Http/Controllers/` (Pengatur Alur)
- **`Controller.php`**: Base controller utama Laravel.
- **`DashboardController.php`**: Mengambil data statistik dari database untuk dikirim ke view dashboard.
- **`SurveyController.php`**: Logika CRUD (Create, Read, Update, Delete) untuk manajemen survey.
- **`ProfileController.php`**: Manajemen data diri pengguna yang sedang login.
#### 📁 `app/Http/Controllers/Auth/`
- **`AuthenticatedSessionController.php`**: Menangani login dan logout.
- **`ConfirmablePasswordController.php`**: Proteksi password untuk aksi sensitif.
- **`EmailVerificationNotificationController.php`**: Pengiriman email verifikasi.
- **`EmailVerificationPromptController.php`**: Tampilan prompt verifikasi email.
- **`NewPasswordController.php`**: Logika pembuatan password baru setelah reset.
- **`PasswordController.php`**: Logika pengubahan password.
- **`PasswordResetLinkController.php`**: Pengiriman link reset password ke email.
- **`RegisteredUserController.php`**: Logika pendaftaran user baru.
- **`VerifyEmailController.php`**: Logika verifikasi email.

### 📁 `app/Services/`
- **`AnalyticsService.php`**: Mesin utama perhitungan statistik. Berisi rumus matematik untuk menghitung skor survey.

### 📁 `app/Imports/`
- **`ResponseImport.php`**: Script untuk membaca file Excel/CSV dan memasukkannya ke database secara otomatis.

### 📁 `app/Providers/`
- **`AppServiceProvider.php`**: Tempat mendaftarkan konfigurasi global atau binding interface di Laravel.

---

## 📂 Folder `database/` (Penyimpanan)

### 📁 `database/migrations/` (Struktur Tabel)
- **`0001_01_01_000000_create_users_table.php`**: Membuat tabel pengguna.
- **`0001_01_01_000001_create_cache_table.php`**: Membuat tabel cache sistem.
- **`0001_01_01_000002_create_jobs_table.php`**: Membuat tabel antrian tugas (queue).
- **`2026_02_11_170646_add_role_to_users_table.php`**: Menambahkan kolom `role` pada tabel user.
- **`2026_02_11_170700_create_regions_table.php`**: Tabel daftar wilayah.
- **`2026_02_11_170701_create_segments_table.php`**: Tabel daftar segmen responden.
- **`2026_02_11_170759_create_surveys_table.php`**: Tabel data utama survey.
- **`2026_02_11_170800_create_questions_table.php`**: Tabel daftar pertanyaan.
- **`2026_02_11_170800_create_responses_table.php`**: Tabel sesi jawaban survey.
- **`2026_02_11_170801_create_response_details_table.php`**: Tabel detail jawaban.
- **`2026_02_11_170802_create_analytics_cache_table.php`**: Tabel cache khusus analisis.
- **`2026_02_11_170802_create_kpi_results_table.php`**: Tabel penyimpanan hasil KPI.

---

## 📂 Folder `resources/` (Antarmuka/UI)

### 📁 `resources/views/` (Template Blade)
- **`dashboard.blade.php`**: Halaman utama panel kontrol dengan grafik.
- **`welcome.blade.php`**: Halaman awal sebelum login.

#### 📁 `resources/views/auth/` (Halaman Keamanan)
- **`login.blade.php`**, **`register.blade.php`**, **`forgot-password.blade.php`**, dsb.

#### 📁 `resources/views/components/` (UI Reusable)
- **`application-logo.blade.php`**: Logo sistem.
- **`modal.blade.php`**: Komponen popup.
- **`primary-button.blade.php`**, **`text-input.blade.php`**, dsb: Komponen dasar form.

#### 📁 `resources/views/layouts/`
- **`app.blade.php`**: Layout utama setelah login.
- **`guest.blade.php`**: Layout untuk halaman publik/login.
- **`navigation.blade.php`**: Komponen navbar/sidebar navigasi.

#### 📁 `resources/views/surveys/`
- **`index.blade.php`**: Halaman list survey.
- **`show.blade.php`**: Halaman detail hasil survey.
- **`create.blade.php`**: Halaman buat survey baru.

---

## 📂 Folder `routes/` (Jalur Akses)
- **`web.php`**: Jalur utama aplikasi web.
- **`auth.php`**: Jalur khusus untuk sistem keamanan (login/logout).
- **`console.php`**: Perintah terminal khusus.

---

## 📂 Folder `config/` (Pengaturan Framework)
- **`app.php`**: Pengaturan nama aplikasi, timezone, locale.
- **`database.php`**: Pengaturan koneksi database (MySQL/SQLite).
- **`auth.php`**: Pengaturan sistem login dan guard.

---

## 📂 Folder `tests/` (Pengujian)
- **`Feature/KpiCalculationTest.php`**: Uji coba otomatis untuk memastikan rumus KPI tidak salah hitung.
- **`Feature/ProfileTest.php`**: Uji coba fitur ubah profil.

---

## 📄 File di Root (Konfigurasi Proyek)
- **`.env`**: File paling penting untuk setting database dan rahasia aplikasi.
- **`artisan`**: Eksekutor perintah Laravel.
- **`vite.config.js`**: Konfigurasi build asset frontend modern.
- **`tailwind.config.js`**: Konfigurasi desain CSS.
- **`composer.json`**: List library PHP (backend).
- **`package.json`**: List library JS (frontend).
- **`STRUKTUR_FOLDER.md`**: Penjelasan fungsi folder.
- **`DAFTAR_FILE.md`**: File ini (Penjelasan detail per file).

---
*Dokumen ini mencakup seluruh file krusial dalam pembangunan website ini.*
