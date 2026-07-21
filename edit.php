<?php
/**
 * edit.php
 * Form edit barang - data dimuat otomatis berdasarkan id.
 */
require_once 'config/koneksi.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    header('Location: index.php');
    exit;
}

// Ambil data barang
$result = mysqli_query($koneksi, "SELECT * FROM barang WHERE id = $id");
if (mysqli_num_rows($result) === 0) {
    header('Location: index.php');
    exit;
}
$barang = mysqli_fetch_assoc($result);

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Barang</li>
                    </ol>
                </nav>

                <div class="card form-card">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h4 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2 text-primary"></i>Edit Barang</h4>
                        <p class="text-muted mb-0">Perbarui data barang di bawah ini.</p>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <?php
                                $errors = [
                                    'semua'   => 'Semua field wajib diisi.',
                                    'numerik' => 'Harga dan Stok harus berupa angka.',
                                    'gagal'   => 'Gagal memperbarui data. Silakan coba lagi.',
                                ];
                                echo $errors[$_GET['error']] ?? 'Terjadi kesalahan.';
                                ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form action="update.php" method="POST" id="formBarang" novalidate>
                            <input type="hidden" name="id" value="<?php echo $barang['id']; ?>">
                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                       value="<?php echo htmlspecialchars($barang['nama_barang']); ?>" required>
                                <div class="invalid-feedback">Nama barang wajib diisi.</div>
                            </div>
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="kategori" name="kategori"
                                       value="<?php echo htmlspecialchars($barang['kategori']); ?>" required>
                                <div class="invalid-feedback">Kategori wajib diisi.</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="harga" name="harga"
                                           value="<?php echo $barang['harga']; ?>" min="0" required>
                                    <div class="invalid-feedback">Harga wajib diisi & harus angka.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="stok" name="stok"
                                           value="<?php echo $barang['stok']; ?>" min="0" required>
                                    <div class="invalid-feedback">Stok wajib diisi & harus angka.</div>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-end mt-4">
                                <a href="index.php" class="btn btn-secondary">
                                    <i class="bi bi-x-lg me-1"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i>Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
