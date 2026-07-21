<?php
/**
 * simpan.php
 * Proses simpan data barang baru.
 */
require_once 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_barang = trim($_POST['nama_barang'] ?? '');
    $kategori    = trim($_POST['kategori'] ?? '');
    $harga       = trim($_POST['harga'] ?? '');
    $stok        = trim($_POST['stok'] ?? '');

    // Validasi semua field wajib diisi
    if ($nama_barang === '' || $kategori === '' || $harga === '' || $stok === '') {
        header('Location: tambah.php?error=semua');
        exit;
    }

    // Validasi harga & stok harus numerik
    if (!is_numeric($harga) || !is_numeric($stok)) {
        header('Location: tambah.php?error=numerik');
        exit;
    }

    // Escape & simpan
    $nama_barang = mysqli_real_escape_string($koneksi, $nama_barang);
    $kategori    = mysqli_real_escape_string($koneksi, $kategori);
    $harga       = (int) $harga;
    $stok        = (int) $stok;

    $query = "INSERT INTO barang (nama_barang, kategori, harga, stok)
              VALUES ('$nama_barang', '$kategori', $harga, $stok)";

    if (mysqli_query($koneksi, $query)) {
        header('Location: index.php?status=sukses');
    } else {
        header('Location: tambah.php?error=gagal');
    }
    exit;
}

// Akses langsung tanpa POST -> kembali ke tambah
header('Location: tambah.php');
exit;
