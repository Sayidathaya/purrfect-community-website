<?php
$isEdit = !empty($event['id']);
$action = $isEdit ? BASE_URL . '/admin/komunitas/event/update' : BASE_URL . '/admin/komunitas/event/store';
?>
<div class="admin-card">
  <form method="POST" action="<?= h($action) ?>" class="row g-3">
    <?= csrf_field() ?>
    <?php if ($isEdit): ?><input type="hidden" name="id" value="<?= (int)$event['id'] ?>"><?php endif; ?>
    <div class="col-md-4"><label class="form-label">Tanggal</label><input class="form-control" name="event_date" value="<?= h($event['event_date'] ?? '') ?>" required></div>
    <div class="col-md-8"><label class="form-label">Judul</label><input class="form-control" name="title" value="<?= h($event['title'] ?? '') ?>" required></div>
    <div class="col-12"><label class="form-label">Deskripsi</label><textarea class="form-control" name="description" required><?= h($event['description'] ?? '') ?></textarea></div>
    <div class="col-12"><label class="form-label">Tag</label><input class="form-control" name="tag" value="<?= h($event['tag'] ?? '') ?>" required></div>
    <div class="col-12">
      <button class="btn btn-primary" type="submit">Simpan</button>
      <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>/admin/komunitas">Batal</a>
    </div>
  </form>
</div>
