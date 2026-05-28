<?php
$isEdit = !empty($thread['id']);
$action = $isEdit ? BASE_URL . '/admin/komunitas/thread/update' : BASE_URL . '/admin/komunitas/thread/store';
?>
<div class="admin-card">
  <form method="POST" action="<?= h($action) ?>" class="row g-3">
    <?= csrf_field() ?>
    <?php if ($isEdit): ?><input type="hidden" name="id" value="<?= (int)$thread['id'] ?>"><?php endif; ?>
    <div class="col-md-4"><label class="form-label">Kategori</label><input class="form-control" name="category" value="<?= h($thread['category'] ?? '') ?>" required></div>
    <div class="col-md-8"><label class="form-label">Judul</label><input class="form-control" name="title" value="<?= h($thread['title'] ?? '') ?>" required></div>
    <div class="col-md-4"><label class="form-label">Author</label><input class="form-control" name="author" value="<?= h($thread['author'] ?? '') ?>" required></div>
    <div class="col-md-2"><label class="form-label">Avatar</label><input class="form-control" name="author_avatar_emoji" value="<?= h($thread['author_avatar_emoji'] ?? '') ?>" required></div>
    <div class="col-md-3"><label class="form-label">Warna Avatar</label><input class="form-control" name="author_avatar_bg" value="<?= h($thread['author_avatar_bg'] ?? '#FFF1E6') ?>" required></div>
    <div class="col-md-3"><label class="form-label">Waktu Publish</label><input class="form-control" name="published_text" value="<?= h($thread['published_text'] ?? 'baru saja') ?>" required></div>
    <div class="col-12"><label class="form-label">Preview</label><textarea class="form-control" name="preview" required><?= h($thread['preview'] ?? '') ?></textarea></div>
    <div class="col-md-4"><label class="form-label">Balasan</label><input class="form-control" type="number" name="replies_count" value="<?= (int)($thread['replies_count'] ?? 0) ?>"></div>
    <div class="col-md-4"><label class="form-label">Dilihat</label><input class="form-control" type="number" name="views_count" value="<?= (int)($thread['views_count'] ?? 0) ?>"></div>
    <div class="col-md-4"><label class="form-label">Suka</label><input class="form-control" type="number" name="likes_count" value="<?= (int)($thread['likes_count'] ?? 0) ?>"></div>
    <div class="col-12">
      <button class="btn btn-primary" type="submit">Simpan</button>
      <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>/admin/komunitas">Batal</a>
    </div>
  </form>
</div>
