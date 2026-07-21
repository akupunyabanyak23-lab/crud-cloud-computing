# Inventory Barang - PHP Native CRUD

Aplikasi web **Inventory Barang** sederhana menggunakan **PHP Native**, **MySQL**, **Bootstrap 5**, dan **Vanilla JavaScript**. Dibuat untuk pembelajaran CRUD (Create, Read, Update, Delete) dengan PHP.

## Tech Stack

- PHP Native (PHP 8+)
- MySQL
- Bootstrap 5 + Bootstrap Icons
- Vanilla JavaScript
- mysqli (procedural)
- Apache / XAMPP

## Fitur

- **Dashboard** dengan 3 statistik (Total Barang, Total Stok, Total Kategori)
- **Daftar Data Barang** dengan tabel Bootstrap
- **Tambah Barang** dengan validasi
- **Edit Barang** (data otomatis termuat)
- **Detail Barang** dalam Bootstrap Card
- **Hapus Barang** dengan konfirmasi modal
- **Live Search** berdasarkan nama barang
- **Alert** notifikasi sukses & error
- Desain modern, responsif, dengan shadow & rounded corners

## Struktur Project

```text
crud-barang/
├── assets/
│   ├── css/style.css
│   ├── js/script.js
│   └── img/
├── config/koneksi.php
├── includes/
│   ├── header.php
│   ├── navbar.php
│   └── footer.php
├── index.php
├── tambah.php
├── simpan.php
├── edit.php
├── update.php
├── hapus.php
├── detail.php
├── database.sql
└── README.md
```

## Instalasi

### 1. Persiapkan XAMPP

Pastikan **Apache** dan **MySQL** sudah berjalan melalui XAMPP Control Panel.

### 2. Salin Project

Salin folder `crud-barang` ke direktori web server:

- **Windows:** `C:\xampp\htdocs\crud-barang`
- **macOS:** `/Applications/XAMPP/htdocs/crud-barang`
- **Linux:** `/opt/lampp/htdocs/crud-barang`

### 3. Import Database

1. Buka browser, kunjungi `http://localhost/phpmyadmin`
2. Klik tab **Import**
3. Pilih file `database.sql` dari folder project
4. Klik **Go / Kirim**

Atau via terminal:

```bash
mysql -u root < database.sql
```

Database `db_barang` beserta tabel `barang` dan data contoh akan otomatis dibuat.

### 4. Konfigurasi Koneksi Database

Buka `config/koneksi.php` dan sesuaikan jika diperlukan:

```php
$host    = 'localhost';
$user    = 'root';
$pass    = '';            // Default XAMPP password kosong
$dbname  = 'db_barang';
```

> Secara default konfigurasi ini sudah cocok untuk XAMPP standar, jadi biasanya tidak perlu diubah.

### 5. Jalankan Aplikasi

Buka browser dan akses:

```
http://localhost/crud-barang/
```

Aplikasi langsung bisa digunakan tanpa konfigurasi tambahan.

## Penggunaan

- **Dashboard:** Menampilkan statistik dan tabel data barang.
- **Tambah Barang:** Klik tombol "Tambah Barang", isi form, lalu Simpan.
- **Edit Barang:** Klik ikon pensil pada kolom Action.
- **Detail Barang:** Klik ikon mata pada kolom Action.
- **Hapus Barang:** Klik ikon tempat sampah, konfirmasi pada modal.
- **Search:** Ketik di kotak pencarian untuk memfilter berdasarkan nama barang.

## Screenshots

> Tambahkan screenshot aplikasi di sini.

1. Dashboard
   ![Dashboard](assets/img/dashboard.png)
2. Tambah Barang
   ![Tambah](assets/img/tambah.png)
3. Detail Barang
   ![Detail](assets/img/detail.png)

## Lisensi

Bebas digunakan untuk pembelajaran.

&copy; 2026 Inventory Barang
