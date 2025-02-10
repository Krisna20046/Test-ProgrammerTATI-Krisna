# README

## Tugas Test Perusahaan TATI

Repository ini berisi kode sumber untuk tugas test dari perusahaan TATI. Semua soal test dikerjakan dalam satu website dan tidak terpisah.

## Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini secara lokal:

### 1. Clone Repository
```bash
git clone [URL_REPOSITORY]
cd [NAMA_FOLDER_PROYEK]
```

### 2. Install Dependensi
Pastikan Anda sudah menginstal [Composer](https://getcomposer.org/) di sistem Anda, lalu jalankan:
```bash
composer install
```

### 3. Konfigurasi Environment
Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi sesuai kebutuhan.
```bash
cp .env.example .env
```

Setelah itu, buat kunci aplikasi dengan menjalankan perintah berikut:
```bash
php artisan key:generate
```

### 4. Import Database
Buka phpMyAdmin atau gunakan terminal untuk mengimpor file SQL yang sudah disediakan:
```bash
mysql -u root -p nama_database < database.sql
```
Sesuaikan `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` di file `.env` agar sesuai dengan pengaturan database Anda.


### 5. Jalankan Server
Jalankan aplikasi dengan perintah berikut:
```bash
php artisan serve
```
Akses aplikasi melalui browser di:
```
http://127.0.0.1:8000
```

## Akun Login
Gunakan akun berikut untuk mengakses aplikasi:

| Email                     | Password |
|---------------------------|----------|
| developer@gmail.com       | password |
| kepaladinas1@gmail.com    | password |
| kepalabidang1@gmail.com   | password |
| kepalabidang2@gmail.com   | password |
| staff1@gmail.com          | password |
| staff2@gmail.com          | password |

Selamat mencoba! Jika ada kendala, silakan periksa kembali langkah-langkah instalasi
