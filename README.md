# Survey & Analysis Dashboard - Sistem Manajemen Survei Modern

[![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-06B6D4?style=for-the-badge&logo=tailwindcss)](https://tailwindcss.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)

<p align="center">
  <!-- Ganti link gambar dengan screenshot aplikasi yang sebenarnya -->
  <img src="https://via.placeholder.com/800x400.png?text=Dashboard+Survey+Preview" alt="Screenshot Dashboard Aplikasi Survey" width="800"/>
</p>

**Survey & Analysis Dashboard** adalah platform berbasis web yang dikembangkan menggunakan **Laravel 12** untuk mempermudah proses pengumpulan, pengelolaan, dan analisis data survei. Aplikasi ini dirancang untuk mendukung kolaborasi antara Admin, Surveyor (Enumerator), dan Analis Data dalam satu ekosistem yang terintegrasi.

## ✨ Fitur Utama

- **Dashboard Interaktif**: Visualisasi data real-time yang menyajikan ringkasan responden, status survei, dan metrik kunci lainnya dalam tampilan grafis yang mudah dipahami.
- **Manajemen Peran Terpadu**: Kontrol akses yang presisi menggunakan `spatie/laravel-permission` untuk membedakan hak akses antara:
    - **Admin**: Kontrol penuh atas sistem dan pengguna.
    - **Surveyor (Enumerator)**: Fokus pada penginputan data lapangan.
    - **Analis**: Akses khusus untuk melihat dan mengekspor laporan.
- **Manajemen Data Survei**: Fitur lengkap untuk mengelola kuesioner, data responden, dan validasi input.
- **Laporan & Ekspor Data Pro**:
    - **Export Excel**: Mengunduh data survei mentah atau terolah menggunakan `maatwebsite/excel`.
    - **Cetak PDF**: Menghasilkan laporan siap cetak dengan `barryvdh/laravel-dompdf`.
- **Desain Responsif**: Antarmuka modern yang dibangun dengan **Tailwind CSS**, memastikan kenyamanan penggunaan baik di desktop maupun perangkat mobile (tablet/smartphone).

## 🛠️ Teknologi & Library

- **Backend**: [PHP](https://www.php.net/) ^8.2
- **Framework**: [Laravel](https://laravel.com/) ^12.0
- **Frontend**: [Blade Templates](https://laravel.com/docs/12.x/blade), [Tailwind CSS](https://tailwindcss.com/)
- **Database**: MySQL / PostgreSQL
- **Library Kunci**:
    - `spatie/laravel-permission`: Manajemen Hak Akses User.
    - `maatwebsite/excel`: Export/Import Data Excel.
    - `barryvdh/laravel-dompdf`: Pembuatan Laporan PDF.
    - `laravel/breeze`: Sistem Autentikasi.

## ⚙️ Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di komputer lokal Anda:

1.  **Clone Repository:**
    ```bash
    git clone https://github.com/username/website-dashboard-analisis.git
    cd website-dashboard-analisis
    ```

2.  **Install Dependensi Backend:**
    ```bash
    composer install
    ```

3.  **Setup Environment:**
    Salin file konfigurasi `.env`.
    ```bash
    cp .env.example .env
    ```

4.  **Generate App Key:**
    ```bash
    php artisan key:generate
    ```

5.  **Konfigurasi Database:**
    Buka file `.env` dan sesuaikan kredensial database Anda (DB_DATABASE, DB_USERNAME, dll).

6.  **Migrasi & Seeding Database:**
    Jalankan migrasi untuk membuat tabel dan seeder untuk data awal (termasuk Role & User default).
    ```bash
    php artisan migrate:fresh --seed
    ```

7.  **Install Dependensi Frontend:**
    ```bash
    npm install
    npm run dev
    ```

8.  **Jalankan Server:**
    Buka terminal baru dan jalankan:
    ```bash
    php artisan serve
    ```
    Akses aplikasi di `http://127.0.0.1:8000`.

## 🚀 Panduan Penggunaan Singkat

1.  **Login Awal**:
    Gunakan akun default yang dibuat oleh seeder (biasanya `admin@example.com` / `password` atau cek `DatabaseSeeder.php`).
2.  **Manajemen User**:
    Masuk sebagai Admin untuk membuat akun bagi Surveyor atau Analis.
3.  **Input Data**:
    Login sebagai Surveyor untuk mulai memasukkan data survei lapangan.
4.  **Analisis & Laporan**:
    Gunakan akun Analis atau Admin untuk melihat grafik dashboard dan mengunduh laporan Excel/PDF.

## 🚦 Roadmap Pengembangan

- [ ] Integrasi peta sebaran responden (GIS).
- [ ] Fitur survei offline dengan sinkronisasi otomatis.
- [ ] Notifikasi real-time untuk validasi data survei.
- [ ] API Token untuk integrasi aplikasi mobile pihak ketiga.
