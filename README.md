## Konsep Website Absensi
website ini di peruntukan untuk perusahaan yang ingin mempunyain system absensi

## Fitur yang tersedia di website
- dashboard
- data karyawan
- data jabatan
- data divisi
- data shift
- pembagian shift
- data kehadiran
- rekap absensi
- konfirmasi kehadiran(absen)
- konfirmasi izin
- users


## users 
<h1>admin</h1>
- memiliki semua akses

<h1>karyawan</h1>
- konfirmasi-kehadiran (absen)
- konfirmasi-keluar
- konfirmasi-izin

## akun untuk pengujian

| email | password |
| ------ | ------ |
| admin@gmail.com | 12345678 |


## persyaratan 
- php 8.0
- laravel 10
- imagick
- web browser

## Entity Relationship Diagram (ERD)
img


## UML Use Case Diagram

img

# Cara intalasi 

1.clone repo
```sh
git clone https://github.com/saefulfazri/ukk_absensi.git
composer install
cp .env.example .env
```

2.Konfigurasi Database pada file `.env`
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=absensi
DB_USERNAME=root
DB_PASSWORD=
```
3.migrasi dan memasukan data 
```sh
php artisan migrate
php artisan db:seed --class=karyawanSeeder
php artsian db:seed --class=AdminSeeder
```
4.run Website
```sh
php artisan serve
```
5.untuk mengrekap data 
note: seharus nya jam 12 malam dia otomatis merekap data jika ingin manual maka jalankan code ini
```sh
rekap:absensi
```

ukk absensi ini di buat oleh muhammad saeful fazri

