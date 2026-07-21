<?php
/**
 * index.php
 * Dashboard + Daftar Data Barang + Search
 */
require_once 'config/koneksi.php';

// Ambil statistik
$totalBarang    = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM barang"))['jml'];
$totalStok      = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COALESCE(SUM(stok),0) AS jml FROM barang"))['jml'];
$totalKategori  = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(DISTINCT kategori) AS jml FROM barang"))['jml'];

// Ambil semua data barang
$result = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY id DESC");

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="main-content">
    <div class="container">

        <!-- Flash message -->
        <?php if (isset($_GET['status'])): ?>
            <?php if ($_GET['status'] == 'sukses'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i> Data barang berhasil disimpan.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php elseif ($_GET['status'] == 'updated'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i> Data barang berhasil diperbarui.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php elseif ($_GET['status'] == 'deleted'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i> Data barang berhasil dihapus.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php elseif ($_GET['status'] == 'gagal'): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i> Terjadi kesalahan. Silakan coba lagi.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Statistik Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card stat-card h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="stat-icon icon-primary me-3">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <div>
                            <div class="stat-value"><?php echo $totalBarang; ?></div>
                            <div class="stat-label">Total Barang</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="stat-icon icon-success me-3">
                            <i class="bi bi-boxes"></i>
                        </div>
                        <div>
                            <div class="stat-value"><?php echo number_format($totalStok); ?></div>
                            <div class="stat-label">Total Stok</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="stat-icon icon-warning me-3">
                            <i class="bi bi-tags"></i>
                        </div>
                        <div>
                            <div class="stat-value"><?php echo $totalKategori; ?></div>
                            <div class="stat-label">Total Kategori</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Barang -->
        <div id="data-barang" class="card data-card">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                <h5 class="mb-0 fw-bold"><i class="bi bi-table me-2"></i>Data Barang</h5>
                <div class="d-flex gap-2 flex-wrap">
                    <div class="input-group input-group-sm" style="width: 260px;">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" id="searchInput" class="form-control border-start-0"
                               placeholder="Cari nama barang...">
                    </div>
                    <a href="tambah.php" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg me-1"></i>Tambah Barang
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width:60px;">No</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Created At</th>
                                <th class="text-end" style="width:160px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="dataBody">
                            <?php
                            $no = 1;
                            if (mysqli_num_rows($result) > 0):
                                while ($row = mysqli_fetch_assoc($result)):
                                    $stokBadge = '';
                                    if ($row['stok'] == 0) {
                                        $stokBadge = 'badge-stok-0';
                                        $stokText   = 'Habis';
                                    } elseif ($row['stok'] <= 5) {
                                        $stokBadge = 'badge-stok-low';
                                        $stokText   = $row['stok'];
                                    } else {
                                        $stokBadge = 'badge-stok-ok';
                                        $stokText   = $row['stok'];
                                    }
                            ?>
                                <tr data-nama="<?php echo htmlspecialchars($row['nama_barang']); ?>">
                                    <td><?php echo $no++; ?></td>
                                    <td class="fw-semibold"><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                                    <td><?php echo htmlspecialchars($row['kategori']); ?></td>
                                    <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                                    <td><span class="badge rounded-pill <?php echo $stokBadge; ?>"><?php echo $stokText; ?></span></td>
                                    <td><small class="text-muted"><?php echo date('d M Y H:i', strtotime($row['created_at'])); ?></small></td>
                                    <td class="text-end">
                                        <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Hapus"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-id="<?php echo $row['id']; ?>"
                                                data-nama="<?php echo htmlspecialchars($row['nama_barang']); ?>">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php
                                endwhile;
                            else:
                            ?>
                                <tr id="noResultRow">
                                    <td colspan="7" class="text-center text-muted py-5">
                                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                        Belum ada data barang.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-danger" id="deleteModalLabel">
                    <i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus barang <strong id="deleteItemName"></strong>?</p>
                <p class="text-muted small mb-0">Data yang sudah dihapus tidak dapat dikembalikan.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" action="" class="d-inline">
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
