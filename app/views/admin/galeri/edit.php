<div class="admin-card">
  <form method="POST" action="<?= BASE_URL ?>/admin/galeri/update" class="row g-3">
    <?= csrf_field() ?>
    <input type="hidden" name="id" value="<?= (int)$race['id'] ?>">
    <div class="col-md-6">
      <label class="form-label">Nama Ras</label>
      <input class="form-control" name="name" value="<?= h($race['name'] ?? '') ?>" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Asal</label>
      <input class="form-control" name="origin" value="<?= h($race['origin'] ?? '') ?>" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Kategori</label>
      <select class="form-select" name="category">
        <option value="Lokal" <?= (($race['category'] ?? '') === 'Lokal') ? 'selected' : '' ?>>Lokal</option>
        <option value="Impor" <?= (($race['category'] ?? '') === 'Impor') ? 'selected' : '' ?>>Impor</option>
      </select>
    </div>
    <div class="col-md-4">
      <label class="form-label">Emoji</label>
      <input class="form-control" name="emoji" value="<?= h($race['emoji'] ?? '') ?>" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Warna Background</label>
      <input class="form-control" name="color_bg" value="<?= h($race['color_bg'] ?? '#FFF1E6') ?>" required>
    </div>
    <div class="col-12">
      <label class="form-label">Deskripsi</label>
      <textarea class="form-control" name="description" required><?= h($race['description'] ?? '') ?></textarea>
    </div>
    <div class="col-12">
      <label class="form-label">Traits, pisahkan dengan koma</label>
      <input class="form-control" name="traits" value="<?= h(implode(', ', $race['traits'] ?? [])) ?>">
    </div>
    <div class="col-12">
      <button class="btn btn-primary" type="submit">Simpan</button>
      <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>/admin/galeri">Batal</a>
    </div>
  </form>
</div>
