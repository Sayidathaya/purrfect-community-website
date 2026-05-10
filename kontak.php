<?php
declare(strict_types=1);

require_once __DIR__ . '/server/queries.php';

$contact = get_contact_info();
$faqs = get_faqs();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Kontak – Purrfect Community</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav>
  <a href="index.php" class="logo">Purrfect<span>Community</span></a>
  <ul class="nav-links" id="navLinks">
    <li><a href="index.php">🏠 Beranda</a></li>
    <li><a href="galeri.php">🐱 Galeri Kucing</a></li>
    <li><a href="favorites.php">★ Favorit</a></li>
    <li><a href="komunitas.php">💬 Komunitas</a></li>
    <li><a href="kontak.php">📬 Kontak</a></li>
    <li><a href="tentang.php">ℹ️ Tentang Kami</a></li>
  </ul>
  <button class="hamburger" id="hamburger" aria-label="menu">
    <span></span><span></span><span></span>
  </button>
</nav>

<div class="page-hero">
  <h1>📬 Hubungi Kami</h1>
  <p>Ada pertanyaan, saran, atau ingin berkolaborasi? Kami senang mendengar dari kamu!</p>
</div>

<div class="contact-wrap">
  <!-- INFO COLUMN -->
  <div class="info-col">
    <div class="info-card">
      <div class="info-icon">📧</div>
      <div>
        <div class="info-title">Email</div>
        <div class="info-text">
          <?= htmlspecialchars((string)($contact['email_primary'] ?? ''), ENT_QUOTES, 'UTF-8') ?><br>
          <?= htmlspecialchars((string)($contact['email_secondary'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
        </div>
      </div>
    </div>

    <div class="info-card">
      <div class="info-icon">📍</div>
      <div>
        <div class="info-title">Lokasi</div>
        <div class="info-text">
          <?= htmlspecialchars((string)($contact['location'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
        </div>
      </div>
    </div>

    <div class="info-card">
      <div class="info-icon">⏰</div>
      <div>
        <div class="info-title">Jam Aktif</div>
        <div class="info-text">
          <?= htmlspecialchars((string)($contact['hours_weekdays'] ?? ''), ENT_QUOTES, 'UTF-8') ?><br>
          <?= htmlspecialchars((string)($contact['hours_saturday'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
        </div>
      </div>
    </div>

    <div style="font-family:'Playfair Display',serif; font-size:1.2rem; margin-top:8px; margin-bottom:12px;">🌐 Temukan Kami di Sosmed</div>

    <div class="social-grid">
      <a class="social-card" href="<?= htmlspecialchars((string)($contact['social_instagram'] ?? '#'), ENT_QUOTES, 'UTF-8') ?>">
        <div class="social-icon">📸</div>
        <div class="social-name">Instagram</div>
      </a>

      <a class="social-card" href="<?= htmlspecialchars((string)($contact['social_whatsapp'] ?? '#'), ENT_QUOTES, 'UTF-8') ?>">
        <div class="social-icon">💬</div>
        <div class="social-name">WhatsApp</div>
      </a>

      <a class="social-card" href="<?= htmlspecialchars((string)($contact['social_youtube'] ?? '#'), ENT_QUOTES, 'UTF-8') ?>">
        <div class="social-icon">▶️</div>
        <div class="social-name">YouTube</div>
      </a>

      <a class="social-card" href="<?= htmlspecialchars((string)($contact['social_tiktok'] ?? '#'), ENT_QUOTES, 'UTF-8') ?>">
        <div class="social-icon">🎵</div>
        <div class="social-name">TikTok</div>
      </a>
    </div>
  </div>

  <!-- FORM COLUMN -->
  <div class="form-col">
    <div class="form-card">
      <div class="form-title">Kirim Pesan ✉️</div>
      <div class="form-sub">Isi formulir di bawah ini dan kami akan membalas dalam 1×24 jam.</div>

      <div class="form-row">
        <div class="form-group">
          <label for="nama">Nama Lengkap</label>
          <input type="text" id="nama" placeholder="Nama kamu...">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" placeholder="email@kamu.com">
        </div>
      </div>

      <div class="form-group">
        <label for="topik">Topik</label>
        <select id="topik">
          <option value="">-- Pilih topik --</option>
          <option>Bergabung dengan Komunitas</option>
          <option>Adopsi Kucing</option>
          <option>Sponsor & Kolaborasi</option>
          <option>Pertanyaan Umum</option>
          <option>Laporan / Saran</option>
        </select>
      </div>

      <div class="form-group">
        <label for="pesan">Pesan</label>
        <textarea id="pesan" placeholder="Tulis pesanmu di sini..."></textarea>
      </div>

      <button class="btn-submit">Kirim Pesan 🐾</button>
      <div class="success-msg" id="successMsg">✅ Pesan berhasil dikirim! Kami akan membalas segera. Meong~</div>
    </div>
  </div>
</div>

<div class="faq-section">
  <div class="faq-title">❓ Pertanyaan Umum</div>
  <div class="faq-list">
    <?php foreach ($faqs as $faq): ?>
      <div class="faq-item">
        <div class="faq-q">
          <?= htmlspecialchars((string)$faq['question'], ENT_QUOTES, 'UTF-8') ?>
          <span class="faq-arrow">▼</span>
        </div>
        <div class="faq-a">
          <?= htmlspecialchars((string)$faq['answer'], ENT_QUOTES, 'UTF-8') ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<footer class="compact">
  <div class="footer-logo">Purrfect Community</div>
  <div class="footer-links">
    <a href="index.php">Beranda</a>
    <a href="galeri.php">Galeri</a>
    <a href="komunitas.php">Komunitas</a>
    <a href="kontak.php">Kontak</a>
    <a href="tentang.php">Tentang</a>
  </div>
  <div class="footer-bottom">© 2025 Purrfect Community · Samarinda, Kalimantan Timur</div>
</footer>

<script src="js/main.js"></script>
</body>
</html>
