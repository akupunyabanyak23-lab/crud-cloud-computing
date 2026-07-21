<?php
/**
 * detail.php
 * Menampilkan detail barang dalam Bootstrap Card.
 */
require_once 'config/koneksi.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    header('Location: index.php');
    exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM barang WHERE id = $id");
if (mysqli_num_rows($result) === 0) {
    header('Location: index.php');
    exit;
}
$barang = mysqli_fetch_assoc($result);

// Status stok
if ($barang['stok'] == 0) {
    $stokStatus = '<span class="badge bg-danger">Habis</span>';
} elseif ($barang['stok'] <= 5) {
    $stokStatus = '<span class="badge bg-warning text-dark">Stok Menipis</span>';
} else {
    $stokStatus = '<span class="badge bg-success">Tersedia</span>';
}

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">

                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Barang</li>
                    </ol>
                </nav>

                <div class="card detail-card">
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center pt-4 px-4">
                        <h4 class="mb-0 fw-bold"><i class="bi bi-info-circle me-2 text-primary"></i>Detail Barang</h4>
                        <?php echo $stokStatus; ?>
                    </div>
                    <div class="card-body px-4 pb-4">

                        <!-- Header ikon -->
                        <div class="text-center mb-4">
                            <div class="stat-icon icon-primary mx-auto mb-3" style="width:80px;height:80px;font-size:2.25rem;">
                                <i class="bi bi-box-seam"></i>
                            </div>
                            <h5 class="fw-bold mb-1"><?php echo htmlspecialchars($barang['nama_barang']); ?></h5>
                            <span class="text-muted"><?php echo htmlspecialchars($barang['kategori']); ?></span>
                        </div>

                        <div class="detail-row row">
                            <div class="col-6 detail-label">ID Barang</div>
                            <div class="col-6 detail-value text-end"><?php echo $barang['id']; ?></div>
                        </div>
                        <div class="detail-row row">
                            <div class="col-6 detail-label">Nama Barang</div>
                            <div class="col-6 detail-value text-end"><?php echo htmlspecialchars($barang['nama_barang']); ?></div>
                        </div>
                        <div class="detail-row row">
                            <div class="col-6 detail-label">Kategori</div>
                            <div class="col-6 detail-value text-end"><?php echo htmlspecialchars($barang['kategori']); ?></div>
                        </div>
                        <div class="detail-row row">
                            <div class="col-6 detail-label">Harga</div>
                            <div class="col-6 detail-value text-end">Rp <?php echo number_format($barang['harga'], 0, ',', '.'); ?></div>
                        </div>
                        <div class="detail-row row">
                            <div class="col-6 detail-label">Stok</div>
                            <div class="col-6 detail-value text-end"><?php echo $barang['stok']; ?> unit</div>
                        </div>
                        <div class="detail-row row">
                            <div class="col-6 detail-label">Dibuat Pada</div>
                            <div class="col-6 detail-value text-end"><?php echo date('d M Y, H:i', strtotime($barang['created_at'])); ?></div>
                        </div>

                        <div class="d-flex gap-2 justify-content-end mt-4">
                            <a href="index.php" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Kembali
                            </a>
                            <a href="edit.php?id=<?php echo $barang['id']; ?>" class="btn btn-warning">
                                <i class="bi bi-pencil me-1"></i>Edit
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
