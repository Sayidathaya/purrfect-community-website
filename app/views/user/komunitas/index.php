<div class="page-hero">
  <h1>💬 Forum Komunitas</h1>
  <p>Diskusi, berbagi pengalaman, dan terhubung dengan sesama pecinta kucing di seluruh Indonesia.</p>
</div>

<div class="content-wrap">

  <div class="main-col">
    <div class="section-title">🔥 Diskusi Terbaru</div>

    <div class="thread-list">
      <?php foreach ($threads as $t): ?>
        <div class="thread-card">
          <div class="thread-top">
            <div class="thread-avatar" style="background:<?= htmlspecialchars((string)($t['author_avatar_bg'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
              <?= htmlspecialchars((string)($t['author_avatar_emoji'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
            </div>
            <div class="thread-meta">
              <span class="thread-category"><?= htmlspecialchars((string)($t['category'] ?? ''), ENT_QUOTES, 'UTF-8') ?></span>
              <div class="thread-title"><?= htmlspecialchars((string)($t['title'] ?? ''), ENT_QUOTES, 'UTF-8') ?></div>
              <div class="thread-author">
                oleh <strong><?= htmlspecialchars((string)($t['author'] ?? ''), ENT_QUOTES, 'UTF-8') ?></strong> ·
                <?= htmlspecialchars((string)($t['published_text'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
              </div>
            </div>
          </div>

          <div class="thread-preview"><?= htmlspecialchars((string)($t['preview'] ?? ''), ENT_QUOTES, 'UTF-8') ?></div>

          <div class="thread-footer">
            <span class="thread-stat">💬 <?= htmlspecialchars((string)($t['replies_count'] ?? 0), ENT_QUOTES, 'UTF-8') ?> balasan</span>
            <span class="thread-stat">👁️ <?= htmlspecialchars((string)($t['views_count'] ?? 0), ENT_QUOTES, 'UTF-8') ?> dilihat</span>
            <span class="thread-stat">❤️ <?= htmlspecialchars((string)($t['likes_count'] ?? 0), ENT_QUOTES, 'UTF-8') ?> suka</span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="section-title" style="margin-top:56px;">📅 Event Komunitas</div>
    <div class="event-cards">
      <?php foreach ($events as $e): ?>
        <div class="event-card">
          <div class="event-date"><?= htmlspecialchars((string)($e['event_date'] ?? ''), ENT_QUOTES, 'UTF-8') ?></div>
          <div class="event-title"><?= htmlspecialchars((string)($e['title'] ?? ''), ENT_QUOTES, 'UTF-8') ?></div>
          <div class="event-desc"><?= htmlspecialchars((string)($e['description'] ?? ''), ENT_QUOTES, 'UTF-8') ?></div>
          <span class="event-tag"><?= htmlspecialchars((string)($e['tag'] ?? ''), ENT_QUOTES, 'UTF-8') ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="side-col">
    <div class="join-card">
      <h3>Bergabung Sekarang! 🐾</h3>
      <p>Jadilah bagian dari komunitas cat lover terbesar di Kalimantan Timur.</p>
      <a href="<?= BASE_URL ?>/kontak" class="btn btn-light">Daftar Gratis</a>
    </div>

    <div class="side-widget" style="margin-top:24px;">
      <h3>👑 Member Aktif</h3>
      <?php foreach ($members as $m): ?>
        <div class="member-item">
          <div class="member-avatar" style="background:<?= htmlspecialchars((string)($m['avatar_bg'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
            <?= htmlspecialchars((string)($m['avatar_emoji'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
          </div>
          <div>
            <div class="member-name"><?= htmlspecialchars((string)($m['name'] ?? ''), ENT_QUOTES, 'UTF-8') ?></div>
            <div class="member-posts"><?= htmlspecialchars((string)($m['posts_count'] ?? 0), ENT_QUOTES, 'UTF-8') ?> postingan</div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="side-widget">
      <h3>🏷️ Topik Populer</h3>
      <div class="tag-cloud">
        <?php foreach ($topicTags as $tag): ?>
          <span class="tag"><?= htmlspecialchars((string)($tag['tag'] ?? ''), ENT_QUOTES, 'UTF-8') ?></span>
        <?php endforeach; ?>
      </div>
    </div>

  </div>
</div>
