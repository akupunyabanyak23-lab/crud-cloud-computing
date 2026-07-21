/* =====================================================
   script.js
   Vanilla JS: live search, delete confirmation modal
   ===================================================== */

document.addEventListener('DOMContentLoaded', function () {

    // ----- Live Search by Nama Barang -----
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase();
            const rows = document.querySelectorAll('#dataBody tr');

            rows.forEach(function (row) {
                const nama = row.getAttribute('data-nama') || '';
                if (nama.toLowerCase().includes(keyword)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Toggle "no results" row
            const noResult = document.getElementById('noResultRow');
            if (noResult) {
                let visible = 0;
                rows.forEach(function (r) {
                    if (r.style.display !== 'none') visible++;
                });
                noResult.style.display = visible === 0 ? '' : 'none';
            }
        });
    }

    // ----- Delete Confirmation Modal -----
    const deleteModal = document.getElementById('deleteModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');
            const form = document.getElementById('deleteForm');
            const nameSpan = document.getElementById('deleteItemName');

            if (form) form.setAttribute('action', 'hapus.php?id=' + encodeURIComponent(id));
            if (nameSpan) nameSpan.textContent = nama;
        });
    }

    // ----- Auto-dismiss alerts after 4 seconds -----
    const alerts = document.querySelectorAll('.alert-dismissible');
    alerts.forEach(function (alert) {
        setTimeout(function () {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
            bsAlert.close();
        }, 4000);
    });

});
