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

hasil:
<img width="959" height="568" alt="image" src="https://github.com/user-attachments/assets/ace3477d-659e-484f-b2a6-83a4aca5a158" />
<img width="959" height="567" alt="image" src="https://github.com/user-attachments/assets/1d51b01e-f440-48bc-859c-0dadf26b622e" />
<img width="959" height="572" alt="image" src="https://github.com/user-attachments/assets/0b168464-1aa0-4d05-930b-878850273b03" />
<img width="959" height="563" alt="image" src="https://github.com/user-attachments/assets/d6000648-06c1-4f2a-8e6a-b6e5c6deeff8" />

bagian edit:
<img width="959" height="536" alt="image" src="https://github.com/user-attachments/assets/d2630c3c-c472-40e0-af0b-fc7f2463ef7f" />

<img width="959" height="544" alt="image" src="https://github.com/user-attachments/assets/ab3dd828-2844-45b6-afc3-483052ac372f" />
<img width="959" height="561" alt="image" src="https://github.com/user-attachments/assets/e95c189e-8633-4f88-9f71-24160c7f18a7" />
<img width="959" height="527" alt="image" src="https://github.com/user-attachments/assets/96d366fd-3d64-4676-aba4-b3bb9eb29d4d" />

hapus:
<img width="959" height="563" alt="image" src="https://github.com/user-attachments/assets/d67e98ec-2235-46d0-8981-3d45f61a265e" />
<img width="959" height="566" alt="image" src="https://github.com/user-attachments/assets/4f7e8165-3955-4b9a-b329-0823240eff77" />







