<?php
/**
 * navbar.php
 * Navigasi atas aplikasi.
 * Kiri: Inventory Barang | Kanan: Dashboard, Data Barang
 */
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            <i class="bi bi-box-seam me-2"></i>Inventory Barang
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <i class="bi bi-speedometer2 me-1"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#data-barang">
                        <i class="bi bi-table me-1"></i>Data Barang
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
