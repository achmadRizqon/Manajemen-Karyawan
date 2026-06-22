# Employee Management System

Aplikasi manajemen karyawan sederhana yang saya buat menggunakan Laravel 12 dan Bootstrap 5.

## Fitur

- Dashboard ringkasan data
- Manajemen department (CRUD)
- Manajemen karyawan (CRUD) dengan fitur search dan sorting
- Validasi form & flash message

## Kebutuhan

- PHP 8.2+
- Composer
- MySQL

## Cara Menjalankan

```bash
git clone https://github.com/username/manajemen-karyawan.git
cd manajemen-karyawan

composer install
cp .env.example .env
php artisan key:generate
```

Sesuaikan konfigurasi database di `.env`, lalu:

```bash
php artisan migrate:fresh --seed
php artisan serve
```

Akses di `http://127.0.0.1:8000`
