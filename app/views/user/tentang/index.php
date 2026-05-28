<div class="about-hero">
  <div class="hero-tag"><?= htmlspecialchars((string)($aboutHero['tag'] ?? ''), ENT_QUOTES, 'UTF-8') ?></div>
  <h1><?= str_replace('&lt;br&gt;', '<br>', htmlspecialchars((string)($aboutHero['heading'] ?? ''), ENT_QUOTES, 'UTF-8')) ?></h1>
  <p><?= htmlspecialchars((string)($aboutHero['description'] ?? ''), ENT_QUOTES, 'UTF-8') ?></p>
</div>

<div class="story-wrap">
  <div class="story-text">
    <h2>Bagaimana Semua Bermula</h2>
    <p>Pada tahun <span class="highlight">2022</span>, sekelompok kecil pecinta kucing di Samarinda mulai bertemu secara rutin di sebuah kafe untuk saling berbagi cerita tentang kucing-kucing mereka. Pertemuan sederhana itu tumbuh menjadi sesuatu yang lebih besar dari yang pernah kami bayangkan.</p>
    <p>Dalam waktu setahun, komunitas kami telah memiliki lebih dari <span class="highlight">500 anggota</span> aktif dari seluruh Kalimantan Timur. Kami sadar bahwa para pecinta kucing membutuhkan satu tempat khusus untuk berbagi, belajar, dan mendukung satu sama lain.</p>
    <p>Itulah mengapa <span class="highlight">Purrfect Community</span> hadir — sebuah rumah digital yang hangat dan inklusif untuk semua orang yang mencintai kucing, dari berbagai latar belakang dan pengalaman.</p>
  </div>
  <div class="story-visual">🐈</div>
</div>

<div class="values-section">
  <div class="section-title">🌟 Nilai-Nilai Kami</div>
  <p class="section-sub">Prinsip yang mendasari setiap langkah komunitas kami.</p>

  <div class="values-flex">
    <?php foreach ($values as $v): ?>
      <div class="value-card">
        <div class="value-icon"><?= htmlspecialchars((string)($v['icon'] ?? ''), ENT_QUOTES, 'UTF-8') ?></div>
        <div class="value-title"><?= htmlspecialchars((string)($v['title'] ?? ''), ENT_QUOTES, 'UTF-8') ?></div>
        <div class="value-text"><?= htmlspecialchars((string)($v['description'] ?? ''), ENT_QUOTES, 'UTF-8') ?></div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<div class="team-section">
  <div class="section-title" style="margin-bottom:10px;">👥 Tim Pengurus</div>
  <p class="section-sub" style="margin-bottom:40px;">Orang-orang di balik Purrfect Community.</p>

  <div class="team-grid">
    <?php foreach ($team as $m): ?>
      <div class="team-card">
        <div class="team-avatar" style="background:<?= htmlspecialchars((string)($m['avatar_bg'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
          <?= htmlspecialchars((string)($m['avatar_emoji'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
        </div>
        <div class="team-name"><?= htmlspecialchars((string)($m['name'] ?? ''), ENT_QUOTES, 'UTF-8') ?></div>
        <div class="team-role"><?= htmlspecialchars((string)($m['role'] ?? ''), ENT_QUOTES, 'UTF-8') ?></div>
        <div class="team-bio"><?= htmlspecialchars((string)($m['bio'] ?? ''), ENT_QUOTES, 'UTF-8') ?></div>
        <div class="team-cat">🐱 Peliharaan: <span><?= htmlspecialchars((string)($m['cats_text'] ?? ''), ENT_QUOTES, 'UTF-8') ?></span></div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<div class="timeline-section">
  <div class="timeline-title">📍 Perjalanan Kami</div>
  <div class="timeline">
    <?php foreach ($timeline as $tl): ?>
      <div class="tl-item">
        <div class="tl-content">
          <div class="tl-year"><?= htmlspecialchars((string)($tl['year'] ?? ''), ENT_QUOTES, 'UTF-8') ?></div>
          <div class="tl-event"><?= htmlspecialchars((string)($tl['event'] ?? ''), ENT_QUOTES, 'UTF-8') ?></div>
          <div class="tl-desc"><?= htmlspecialchars((string)($tl['description'] ?? ''), ENT_QUOTES, 'UTF-8') ?></div>
        </div>
        <div class="tl-dot"><?= htmlspecialchars((string)($tl['dot_emoji'] ?? ''), ENT_QUOTES, 'UTF-8') ?></div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<div class="cta-section">
  <h2>Jadilah Bagian dari Keluarga Kami 🐾</h2>
  <p>Bergabunglah dengan lebih dari 2.400 pecinta kucing yang aktif berbagi dan saling mendukung setiap harinya.</p>
  <a href="<?= BASE_URL ?>/kontak" class="btn btn-light">Bergabung Sekarang</a>
</div>
