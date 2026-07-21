<?php
/**
 * koneksi.php
 * Koneksi database menggunakan mysqli (procedural).
 * Sesuaikan $host, $user, $pass, $dbname jika konfigurasi XAMPP Anda berbeda.
 */

$host = "db";
$user    = 'root';
$pass    = 'password';
$dbname  = 'barang_db';

// Buat koneksi
$koneksi = mysqli_connect($host, $user, $pass, $dbname);

// Cek koneksi
if (!$koneksi) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}

// Set charset ke utf8mb4
mysqli_set_charset($koneksi, 'utf8mb4');
