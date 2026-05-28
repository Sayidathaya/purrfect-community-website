<div class="admin-card">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h5 mb-0">Pesan Masuk</h2>
    <a class="btn btn-outline-primary" href="<?= BASE_URL ?>/admin/kontak/settings">Pengaturan Kontak</a>
  </div>
  <div class="table-responsive">
    <table class="table">
      <thead><tr><th>Nama</th><th>Email</th><th>Topik</th><th>Pesan</th><th>Tanggal</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php foreach ($messages as $message): ?>
        <tr>
          <td><?= h($message['name'] ?? '') ?></td>
          <td><a href="mailto:<?= h($message['email'] ?? '') ?>"><?= h($message['email'] ?? '') ?></a></td>
          <td><?= h($message['topic'] ?? '') ?></td>
          <td><?= h($message['message'] ?? '') ?></td>
          <td><?= h($message['created_at'] ?? '') ?></td>
          <td>
            <form method="POST" action="<?= BASE_URL ?>/admin/kontak/pesan/delete" onsubmit="return confirmDelete(event, this)">
              <?= csrf_field() ?>
              <input type="hidden" name="id" value="<?= (int)$message['id'] ?>">
              <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if (empty($messages)): ?>
        <tr><td colspan="6" class="text-muted">Belum ada pesan masuk.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
