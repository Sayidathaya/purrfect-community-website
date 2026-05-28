<div class="admin-card">
  <h2 class="h5">Hero Badge</h2>
  <form method="POST" action="<?= BASE_URL ?>/admin/beranda/hero/update">
    <?= csrf_field() ?>
    <div class="input-group">
      <input class="form-control" name="badge_text" value="<?= h($hero['badge_text'] ?? '') ?>" required>
      <button class="btn btn-primary" type="submit">Simpan</button>
    </div>
  </form>
</div>

<div class="admin-card">
  <h2 class="h5">Statistik</h2>
  <form method="POST" action="<?= BASE_URL ?>/admin/beranda/stats/update">
    <?= csrf_field() ?>
    <div class="row g-3">
      <?php foreach ($stats as $stat): ?>
        <div class="col-md-6">
          <input type="hidden" name="id[]" value="<?= (int)$stat['id'] ?>">
          <label class="form-label">Angka</label>
          <input class="form-control mb-2" name="number_text[]" value="<?= h($stat['number_text'] ?? '') ?>" required>
          <label class="form-label">Label</label>
          <input class="form-control" name="label_text[]" value="<?= h($stat['label_text'] ?? '') ?>" required>
        </div>
      <?php endforeach; ?>
    </div>
    <button class="btn btn-primary mt-3" type="submit">Simpan Statistik</button>
  </form>
</div>

<div class="admin-card">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h5 mb-0">Artikel Populer</h2>
  </div>
  <form class="row g-2 mb-4" method="POST" action="<?= BASE_URL ?>/admin/beranda/artikel/store">
    <?= csrf_field() ?>
    <div class="col-md-2"><input class="form-control" name="tag" placeholder="Tag" required></div>
    <div class="col-md-3"><input class="form-control" name="title" placeholder="Judul" required></div>
    <div class="col-md-5"><input class="form-control" name="description" placeholder="Deskripsi" required></div>
    <div class="col-md-2"><button class="btn btn-success w-100" type="submit">Tambah</button></div>
  </form>
  <div class="table-responsive">
    <table class="table">
      <thead><tr><th>Tag</th><th>Judul</th><th>Deskripsi</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php foreach ($articles as $article): ?>
        <tr>
          <form method="POST" action="<?= BASE_URL ?>/admin/beranda/artikel/update">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= (int)$article['id'] ?>">
            <td><input class="form-control" name="tag" value="<?= h($article['tag'] ?? '') ?>"></td>
            <td><input class="form-control" name="title" value="<?= h($article['title'] ?? '') ?>"></td>
            <td><input class="form-control" name="description" value="<?= h($article['description'] ?? '') ?>"></td>
            <td class="text-nowrap">
              <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
          </form>
              <form method="POST" action="<?= BASE_URL ?>/admin/beranda/artikel/delete" class="d-inline" onsubmit="return confirmDelete(event, this)">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= (int)$article['id'] ?>">
                <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
              </form>
            </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<div class="admin-card">
  <h2 class="h5">Tips Merawat Kucing</h2>
  <form class="row g-2 mb-4" method="POST" action="<?= BASE_URL ?>/admin/beranda/tips/store">
    <?= csrf_field() ?>
    <div class="col-md-2"><input class="form-control" name="icon" placeholder="Icon" required></div>
    <div class="col-md-3"><input class="form-control" name="title" placeholder="Judul" required></div>
    <div class="col-md-5"><input class="form-control" name="description" placeholder="Deskripsi" required></div>
    <div class="col-md-2"><button class="btn btn-success w-100" type="submit">Tambah</button></div>
  </form>
  <div class="table-responsive">
    <table class="table">
      <thead><tr><th>Icon</th><th>Judul</th><th>Deskripsi</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php foreach ($tips as $tip): ?>
        <tr>
          <form method="POST" action="<?= BASE_URL ?>/admin/beranda/tips/update">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= (int)$tip['id'] ?>">
            <td><input class="form-control" name="icon" value="<?= h($tip['icon'] ?? '') ?>"></td>
            <td><input class="form-control" name="title" value="<?= h($tip['title'] ?? '') ?>"></td>
            <td><input class="form-control" name="description" value="<?= h($tip['description'] ?? '') ?>"></td>
            <td class="text-nowrap">
              <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
          </form>
              <form method="POST" action="<?= BASE_URL ?>/admin/beranda/tips/delete" class="d-inline" onsubmit="return confirmDelete(event, this)">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= (int)$tip['id'] ?>">
                <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
              </form>
            </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<div class="admin-card">
  <h2 class="h5">CTA Banner</h2>
  <form method="POST" action="<?= BASE_URL ?>/admin/beranda/cta/update" class="row g-3">
    <?= csrf_field() ?>
    <div class="col-md-6">
      <label class="form-label">Heading</label>
      <input class="form-control" name="heading" value="<?= h($cta['heading'] ?? '') ?>" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Tombol</label>
      <input class="form-control" name="button_text" value="<?= h($cta['button_text'] ?? '') ?>" required>
    </div>
    <div class="col-md-8">
      <label class="form-label">Deskripsi</label>
      <textarea class="form-control" name="description" required><?= h($cta['description'] ?? '') ?></textarea>
    </div>
    <div class="col-md-4">
      <label class="form-label">Link</label>
      <input class="form-control" name="button_href" value="<?= h($cta['button_href'] ?? '') ?>" required>
    </div>
    <div class="col-12">
      <button class="btn btn-primary" type="submit">Simpan CTA</button>
    </div>
  </form>
</div>
