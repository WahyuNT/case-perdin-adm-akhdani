# Case Perdin Akhdani

Aplikasi berbasis Laravel untuk mengelola perjalanan dinas (perdin) untuk Test Tahap 1 Akhdani.

## 🔧 Panduan Instalasi

Ikuti langkah-langkah berikut untuk menginstal proyek :

1. Clone repositori
```bash
git clone https://github.com/WahyuNT/case-perdin-adm-akhdani.git
```

2. Masuk ke direktori proyek dan instal dependensi PHP
```bash
composer install
```

3. Buat file konfigurasi lingkungan
```bash
cp .env.example .env
```

4. Generate kunci aplikasi
```bash
php artisan key:generate
```

5. Jalankan migrasi dan seed database
```bash
php artisan migrate --seed
```
Catatan: Jika diminta, pilih "yes" untuk membuat database.

6. Jalankan server pengembangan
```bash
php artisan serve
```

Kini anda dapat menjalankan aplikasi

## 🔐 Informasi Login Default
Setelah menjalankan perintah php artisan migrate --seed, sistem secara otomatis akan membuat satu akun admin dengan kredensial berikut:
```bash
Username: admin 
Password: admin
```

## 🔗 Tautan

- {url}/perdinku - Halaman untuk pegawai melihat data perjalanan dinas dan mengajukan perjalanan dinas baru
- {url}/manajemen-user - Halaman untuk admin mengatur akun pengguna
- {url}/master-kota - Halaman untuk divisi SDM untuk mengatur data kota
- {url}/pengajuan-perdin - Halaman untuk divisi SDM mereview permintaan perjalanan dinas

## ✨ Fitur 
- Responsive untuk tampilan Mobile dan Desktop
- Dapat mencari latitude dan longitude secara otomatis menggunakan API OpenStreetMap 
- CRUD dapat dilakukan tanpa perlu me-refresh halaman

## 🖥️ Persyaratan

- PHP 8.0 atau lebih tinggi
- Composer
- MySQL
- Laravel 10.x

##

Proyek ini di buat oleh [Wahyu Nusantara](https://wahyunt.me/)