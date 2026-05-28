<div class="admin-card">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h5 mb-0">Daftar Ras Kucing</h2>
    <a class="btn btn-success" href="<?= BASE_URL ?>/admin/galeri/create">Tambah Ras</a>
  </div>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Asal</th>
          <th>Kategori</th>
          <th>Traits</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($races as $race): ?>
          <tr>
            <td><?= h($race['emoji'] ?? '') ?> <?= h($race['name'] ?? '') ?></td>
            <td><?= h($race['origin'] ?? '') ?></td>
            <td><?= h($race['category'] ?? '') ?></td>
            <td><?= h(implode(', ', $race['traits'] ?? [])) ?></td>
            <td class="text-nowrap">
              <a class="btn btn-sm btn-primary" href="<?= BASE_URL ?>/admin/galeri/edit?id=<?= (int)$race['id'] ?>">Edit</a>
              <form method="POST" action="<?= BASE_URL ?>/admin/galeri/delete" class="d-inline" onsubmit="return confirmDelete(event, this)">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= (int)$race['id'] ?>">
                <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
