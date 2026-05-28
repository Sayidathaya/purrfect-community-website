<ul class="nav nav-tabs mb-3" role="tablist">
  <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#threads" type="button">Diskusi</button></li>
  <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#events" type="button">Event</button></li>
  <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#members" type="button">Member</button></li>
  <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tags" type="button">Tags</button></li>
</ul>

<div class="tab-content">
  <div class="tab-pane fade show active" id="threads">
    <div class="admin-card">
      <div class="d-flex justify-content-between mb-3">
        <h2 class="h5 mb-0">Diskusi Forum</h2>
        <a class="btn btn-success" href="<?= BASE_URL ?>/admin/komunitas/thread/create">Tambah Diskusi</a>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead><tr><th>Kategori</th><th>Judul</th><th>Penulis</th><th>Stat</th><th>Aksi</th></tr></thead>
          <tbody>
          <?php foreach ($threads as $thread): ?>
            <tr>
              <td><?= h($thread['category'] ?? '') ?></td>
              <td><?= h($thread['title'] ?? '') ?></td>
              <td><?= h($thread['author'] ?? '') ?></td>
              <td><?= (int)$thread['replies_count'] ?> / <?= (int)$thread['views_count'] ?> / <?= (int)$thread['likes_count'] ?></td>
              <td class="text-nowrap">
                <a class="btn btn-sm btn-primary" href="<?= BASE_URL ?>/admin/komunitas/thread/edit?id=<?= (int)$thread['id'] ?>">Edit</a>
                <form method="POST" action="<?= BASE_URL ?>/admin/komunitas/thread/delete" class="d-inline" onsubmit="return confirmDelete(event, this)">
                  <?= csrf_field() ?>
                  <input type="hidden" name="id" value="<?= (int)$thread['id'] ?>">
                  <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="events">
    <div class="admin-card">
      <div class="d-flex justify-content-between mb-3">
        <h2 class="h5 mb-0">Event Komunitas</h2>
        <a class="btn btn-success" href="<?= BASE_URL ?>/admin/komunitas/event/create">Tambah Event</a>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead><tr><th>Tanggal</th><th>Judul</th><th>Tag</th><th>Aksi</th></tr></thead>
          <tbody>
          <?php foreach ($events as $event): ?>
            <tr>
              <td><?= h($event['event_date'] ?? '') ?></td>
              <td><?= h($event['title'] ?? '') ?></td>
              <td><?= h($event['tag'] ?? '') ?></td>
              <td class="text-nowrap">
                <a class="btn btn-sm btn-primary" href="<?= BASE_URL ?>/admin/komunitas/event/edit?id=<?= (int)$event['id'] ?>">Edit</a>
                <form method="POST" action="<?= BASE_URL ?>/admin/komunitas/event/delete" class="d-inline" onsubmit="return confirmDelete(event, this)">
                  <?= csrf_field() ?>
                  <input type="hidden" name="id" value="<?= (int)$event['id'] ?>">
                  <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="members">
    <div class="admin-card">
      <h2 class="h5">Member Aktif</h2>
      <form class="row g-2 mb-4" method="POST" action="<?= BASE_URL ?>/admin/komunitas/member/store">
        <?= csrf_field() ?>
        <div class="col-md-3"><input class="form-control" name="name" placeholder="Nama" required></div>
        <div class="col-md-2"><input class="form-control" name="avatar_emoji" placeholder="Avatar" required></div>
        <div class="col-md-2"><input class="form-control" name="avatar_bg" value="#FFF1E6" required></div>
        <div class="col-md-2"><input class="form-control" type="number" name="posts_count" value="0" min="0"></div>
        <div class="col-md-3"><button class="btn btn-success w-100" type="submit">Tambah Member</button></div>
      </form>
      <?php foreach ($members as $member): ?>
        <div class="d-flex justify-content-between align-items-center border-top py-2">
          <div><?= h($member['avatar_emoji'] ?? '') ?> <?= h($member['name'] ?? '') ?> <span class="text-muted">(<?= (int)$member['posts_count'] ?> postingan)</span></div>
          <form method="POST" action="<?= BASE_URL ?>/admin/komunitas/member/delete" onsubmit="return confirmDelete(event, this)">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= (int)$member['id'] ?>">
            <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
          </form>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="tab-pane fade" id="tags">
    <div class="admin-card">
      <h2 class="h5">Topik Populer</h2>
      <form class="input-group mb-4" method="POST" action="<?= BASE_URL ?>/admin/komunitas/tag/store">
        <?= csrf_field() ?>
        <input class="form-control" name="tag" placeholder="#Kesehatan" required>
        <button class="btn btn-success" type="submit">Tambah Tag</button>
      </form>
      <div class="d-flex flex-wrap gap-2">
        <?php foreach ($tags as $tag): ?>
          <form method="POST" action="<?= BASE_URL ?>/admin/komunitas/tag/delete" onsubmit="return confirmDelete(event, this)">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= (int)$tag['id'] ?>">
            <button class="btn btn-outline-danger btn-sm" type="submit"><?= h($tag['tag'] ?? '') ?> x</button>
          </form>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
