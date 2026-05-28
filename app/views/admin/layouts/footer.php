  </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script src="<?= BASE_URL ?>/assets/js/app.js"></script>
<?php if (!empty($_SESSION['success'])): ?>
<script>
document.addEventListener('DOMContentLoaded', () => {
  Swal.fire({icon: 'success', title: 'Berhasil', text: <?= json_encode((string)$_SESSION['success']) ?>});
});
</script>
<?php unset($_SESSION['success']); endif; ?>
<?php if (!empty($_SESSION['error'])): ?>
<script>
document.addEventListener('DOMContentLoaded', () => {
  Swal.fire({icon: 'error', title: 'Gagal', text: <?= json_encode((string)$_SESSION['error']) ?>});
});
</script>
<?php unset($_SESSION['error']); endif; ?>
</body>
</html>
