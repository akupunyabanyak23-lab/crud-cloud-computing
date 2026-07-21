<?php
/**
 * update.php
 * Proses update data barang berdasarkan id.
 */
require_once 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id         = (int) ($_POST['id'] ?? 0);
    $nama_barang = trim($_POST['nama_barang'] ?? '');
    $kategori    = trim($_POST['kategori'] ?? '');
    $harga       = trim($_POST['harga'] ?? '');
    $stok        = trim($_POST['stok'] ?? '');

    // Validasi semua field wajib diisi
    if ($id <= 0 || $nama_barang === '' || $kategori === '' || $harga === '' || $stok === '') {
        header('Location: edit.php?id=' . $id . '&error=semua');
        exit;
    }

    // Validasi harga & stok harus numerik
    if (!is_numeric($harga) || !is_numeric($stok)) {
        header('Location: edit.php?id=' . $id . '&error=numerik');
        exit;
    }

    // Escape & update
    $nama_barang = mysqli_real_escape_string($koneksi, $nama_barang);
    $kategori    = mysqli_real_escape_string($koneksi, $kategori);
    $harga       = (int) $harga;
    $stok        = (int) $stok;

    $query = "UPDATE barang SET
                nama_barang = '$nama_barang',
                kategori    = '$kategori',
                harga       = $harga,
                stok        = $stok
              WHERE id = $id";

    if (mysqli_query($koneksi, $query)) {
        header('Location: index.php?status=updated');
    } else {
        header('Location: edit.php?id=' . $id . '&error=gagal');
    }
    exit;
}

header('Location: index.php');
exit;
