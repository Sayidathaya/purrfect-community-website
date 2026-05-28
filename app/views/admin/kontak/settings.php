<div class="admin-card">
  <h2 class="h5">Info Kontak</h2>
  <form method="POST" action="<?= BASE_URL ?>/admin/kontak/info/update" class="row g-3">
    <?= csrf_field() ?>
    <div class="col-md-6"><label class="form-label">Email Utama</label><input class="form-control" name="email_primary" value="<?= h($contact['email_primary'] ?? '') ?>" required></div>
    <div class="col-md-6"><label class="form-label">Email Kedua</label><input class="form-control" name="email_secondary" value="<?= h($contact['email_secondary'] ?? '') ?>" required></div>
    <div class="col-12"><label class="form-label">Lokasi</label><input class="form-control" name="location" value="<?= h($contact['location'] ?? '') ?>" required></div>
    <div class="col-md-6"><label class="form-label">Jam Weekdays</label><input class="form-control" name="hours_weekdays" value="<?= h($contact['hours_weekdays'] ?? '') ?>" required></div>
    <div class="col-md-6"><label class="form-label">Jam Sabtu</label><input class="form-control" name="hours_saturday" value="<?= h($contact['hours_saturday'] ?? '') ?>" required></div>
    <div class="col-md-3"><label class="form-label">Instagram</label><input class="form-control" name="social_instagram" value="<?= h($contact['social_instagram'] ?? '#') ?>" required></div>
    <div class="col-md-3"><label class="form-label">WhatsApp</label><input class="form-control" name="social_whatsapp" value="<?= h($contact['social_whatsapp'] ?? '#') ?>" required></div>
    <div class="col-md-3"><label class="form-label">YouTube</label><input class="form-control" name="social_youtube" value="<?= h($contact['social_youtube'] ?? '#') ?>" required></div>
    <div class="col-md-3"><label class="form-label">TikTok</label><input class="form-control" name="social_tiktok" value="<?= h($contact['social_tiktok'] ?? '#') ?>" required></div>
    <div class="col-12"><button class="btn btn-primary" type="submit">Simpan Info</button></div>
  </form>
</div>

<div class="admin-card">
  <h2 class="h5">FAQ</h2>
  <form class="row g-2 mb-4" method="POST" action="<?= BASE_URL ?>/admin/kontak/faq/store">
    <?= csrf_field() ?>
    <div class="col-md-4"><input class="form-control" name="question" placeholder="Pertanyaan" required></div>
    <div class="col-md-6"><input class="form-control" name="answer" placeholder="Jawaban" required></div>
    <div class="col-md-2"><button class="btn btn-success w-100" type="submit">Tambah</button></div>
  </form>
  <div class="table-responsive">
    <table class="table">
      <thead><tr><th>Pertanyaan</th><th>Jawaban</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php foreach ($faqs as $faq): ?>
        <tr>
          <form method="POST" action="<?= BASE_URL ?>/admin/kontak/faq/update">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= (int)$faq['id'] ?>">
            <td><textarea class="form-control" name="question"><?= h($faq['question'] ?? '') ?></textarea></td>
            <td><textarea class="form-control" name="answer"><?= h($faq['answer'] ?? '') ?></textarea></td>
            <td class="text-nowrap">
              <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
          </form>
              <form method="POST" action="<?= BASE_URL ?>/admin/kontak/faq/delete" class="d-inline" onsubmit="return confirmDelete(event, this)">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= (int)$faq['id'] ?>">
                <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
              </form>
            </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
