<?php
/**
 * hapus.php
 * Proses hapus data barang berdasarkan id.
 */
require_once 'config/koneksi.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id > 0) {
    $query = "DELETE FROM barang WHERE id = $id";
    if (mysqli_query($koneksi, $query)) {
        header('Location: index.php?status=deleted');
    } else {
        header('Location: index.php?status=gagal');
    }
    exit;
}

header('Location: index.php');
exit;
