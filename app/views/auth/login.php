<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= h($title ?? 'Login Admin') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin.css">
</head>
<body>
  <main class="min-vh-100 d-flex align-items-center justify-content-center p-3">
    <div class="admin-card" style="max-width:420px;width:100%;">
      <div class="text-center mb-4">
        <div class="admin-brand text-dark mb-2">Purrfect<span>Admin</span></div>
        <p class="text-muted mb-0">Masuk untuk mengelola konten komunitas.</p>
      </div>
      <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= h($error) ?></div>
      <?php endif; ?>
      <form method="POST" action="<?= BASE_URL ?>/admin/login/proses">
        <?= csrf_field() ?>
        <div class="mb-3">
          <label class="form-label" for="username">Username</label>
          <input class="form-control" id="username" name="username" autocomplete="username" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="password">Password</label>
          <input class="form-control" id="password" type="password" name="password" autocomplete="current-password" required>
        </div>
        <button class="btn btn-primary w-100" type="submit">Login</button>
      </form>
    </div>
  </main>
</body>
</html>
