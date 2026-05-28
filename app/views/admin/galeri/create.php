<div class="admin-card">
  <form method="POST" action="<?= BASE_URL ?>/admin/galeri/store" class="row g-3">
    <?= csrf_field() ?>
    <div class="col-md-6">
      <label class="form-label">Nama Ras</label>
      <input class="form-control" name="name" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Asal</label>
      <input class="form-control" name="origin" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Kategori</label>
      <select class="form-select" name="category">
        <option value="Lokal">Lokal</option>
        <option value="Impor">Impor</option>
      </select>
    </div>
    <div class="col-md-4">
      <label class="form-label">Emoji</label>
      <input class="form-control" name="emoji" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Warna Background</label>
      <input class="form-control" name="color_bg" value="#FFF1E6" required>
    </div>
    <div class="col-12">
      <label class="form-label">Deskripsi</label>
      <textarea class="form-control" name="description" required></textarea>
    </div>
    <div class="col-12">
      <label class="form-label">Traits, pisahkan dengan koma</label>
      <input class="form-control" name="traits" placeholder="Mandiri, Cerdas, Bulu Panjang">
    </div>
    <div class="col-12">
      <button class="btn btn-primary" type="submit">Simpan</button>
      <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>/admin/galeri">Batal</a>
    </div>
  </form>
</div>
