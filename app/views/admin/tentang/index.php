<div class="admin-card">
  <h2 class="h5">Hero Tentang</h2>
  <form method="POST" action="<?= BASE_URL ?>/admin/tentang/hero/update" class="row g-3">
    <?= csrf_field() ?>
    <div class="col-md-4"><label class="form-label">Tag</label><input class="form-control" name="tag" value="<?= h($hero['tag'] ?? '') ?>" required></div>
    <div class="col-md-8"><label class="form-label">Heading</label><input class="form-control" name="heading" value="<?= h($hero['heading'] ?? '') ?>" required></div>
    <div class="col-12"><label class="form-label">Deskripsi</label><textarea class="form-control" name="description" required><?= h($hero['description'] ?? '') ?></textarea></div>
    <div class="col-12"><button class="btn btn-primary" type="submit">Simpan Hero</button></div>
  </form>
</div>

<div class="admin-card">
  <h2 class="h5">Nilai-Nilai</h2>
  <form class="row g-2 mb-4" method="POST" action="<?= BASE_URL ?>/admin/tentang/values/store">
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
      <?php foreach ($values as $value): ?>
        <tr>
          <form method="POST" action="<?= BASE_URL ?>/admin/tentang/values/update">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= (int)$value['id'] ?>">
            <td><input class="form-control" name="icon" value="<?= h($value['icon'] ?? '') ?>"></td>
            <td><input class="form-control" name="title" value="<?= h($value['title'] ?? '') ?>"></td>
            <td><input class="form-control" name="description" value="<?= h($value['description'] ?? '') ?>"></td>
            <td class="text-nowrap">
              <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
          </form>
              <form method="POST" action="<?= BASE_URL ?>/admin/tentang/values/delete" class="d-inline" onsubmit="return confirmDelete(event, this)">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= (int)$value['id'] ?>">
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
  <h2 class="h5">Tim Pengurus</h2>
  <form class="row g-2 mb-4" method="POST" action="<?= BASE_URL ?>/admin/tentang/team/store">
    <?= csrf_field() ?>
    <div class="col-md-3"><input class="form-control" name="name" placeholder="Nama" required></div>
    <div class="col-md-3"><input class="form-control" name="role" placeholder="Role" required></div>
    <div class="col-md-2"><input class="form-control" name="avatar_emoji" placeholder="Avatar" required></div>
    <div class="col-md-2"><input class="form-control" name="avatar_bg" value="#FFF1E6" required></div>
    <div class="col-md-2"><button class="btn btn-success w-100" type="submit">Tambah</button></div>
    <div class="col-md-6"><input class="form-control" name="bio" placeholder="Bio" required></div>
    <div class="col-md-6"><input class="form-control" name="cats_text" placeholder="Peliharaan" required></div>
  </form>
  <div class="table-responsive">
    <table class="table">
      <thead><tr><th>Nama</th><th>Role</th><th>Bio</th><th>Peliharaan</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php foreach ($team as $member): ?>
        <tr>
          <form method="POST" action="<?= BASE_URL ?>/admin/tentang/team/update">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= (int)$member['id'] ?>">
            <td>
              <input class="form-control mb-1" name="name" value="<?= h($member['name'] ?? '') ?>">
              <input class="form-control mb-1" name="avatar_emoji" value="<?= h($member['avatar_emoji'] ?? '') ?>">
              <input class="form-control" name="avatar_bg" value="<?= h($member['avatar_bg'] ?? '') ?>">
            </td>
            <td><input class="form-control" name="role" value="<?= h($member['role'] ?? '') ?>"></td>
            <td><textarea class="form-control" name="bio"><?= h($member['bio'] ?? '') ?></textarea></td>
            <td><textarea class="form-control" name="cats_text"><?= h($member['cats_text'] ?? '') ?></textarea></td>
            <td class="text-nowrap">
              <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
          </form>
              <form method="POST" action="<?= BASE_URL ?>/admin/tentang/team/delete" class="d-inline" onsubmit="return confirmDelete(event, this)">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= (int)$member['id'] ?>">
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
  <h2 class="h5">Timeline</h2>
  <form class="row g-2 mb-4" method="POST" action="<?= BASE_URL ?>/admin/tentang/timeline/store">
    <?= csrf_field() ?>
    <div class="col-md-2"><input class="form-control" name="year" placeholder="Tahun" required></div>
    <div class="col-md-3"><input class="form-control" name="event" placeholder="Event" required></div>
    <div class="col-md-5"><input class="form-control" name="description" placeholder="Deskripsi" required></div>
    <div class="col-md-1"><input class="form-control" name="dot_emoji" placeholder="Icon" required></div>
    <div class="col-md-1"><button class="btn btn-success w-100" type="submit">+</button></div>
  </form>
  <div class="table-responsive">
    <table class="table">
      <thead><tr><th>Tahun</th><th>Event</th><th>Deskripsi</th><th>Icon</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php foreach ($timeline as $item): ?>
        <tr>
          <form method="POST" action="<?= BASE_URL ?>/admin/tentang/timeline/update">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= (int)$item['id'] ?>">
            <td><input class="form-control" name="year" value="<?= h($item['year'] ?? '') ?>"></td>
            <td><input class="form-control" name="event" value="<?= h($item['event'] ?? '') ?>"></td>
            <td><input class="form-control" name="description" value="<?= h($item['description'] ?? '') ?>"></td>
            <td><input class="form-control" name="dot_emoji" value="<?= h($item['dot_emoji'] ?? '') ?>"></td>
            <td class="text-nowrap">
              <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
          </form>
              <form method="POST" action="<?= BASE_URL ?>/admin/tentang/timeline/delete" class="d-inline" onsubmit="return confirmDelete(event, this)">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= (int)$item['id'] ?>">
                <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
              </form>
            </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
