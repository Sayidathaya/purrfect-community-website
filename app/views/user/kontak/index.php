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
    <form class="form-card" method="POST" action="<?= BASE_URL ?>/kontak">
      <?= csrf_field() ?>
      <div class="form-title">Kirim Pesan ✉️</div>
      <div class="form-sub">Isi formulir di bawah ini dan kami akan membalas dalam 1×24 jam.</div>

      <?php if (!empty($success)): ?>
        <div class="success-msg" style="display:block;"><?= htmlspecialchars((string)$success, ENT_QUOTES, 'UTF-8') ?></div>
      <?php endif; ?>
      <?php if (!empty($error)): ?>
        <p class="form-error" style="color:#C0392B; font-size:.88rem; margin-top:10px; font-weight:700;">
          <?= htmlspecialchars((string)$error, ENT_QUOTES, 'UTF-8') ?>
        </p>
      <?php endif; ?>

      <div class="form-row">
        <div class="form-group">
          <label for="nama">Nama Lengkap</label>
          <input type="text" id="nama" name="nama" placeholder="Nama kamu..." required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="email@kamu.com" required>
        </div>
      </div>

      <div class="form-group">
        <label for="topik">Topik</label>
        <select id="topik" name="topik" required>
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
        <textarea id="pesan" name="pesan" placeholder="Tulis pesanmu di sini..." required></textarea>
      </div>

      <button class="btn-submit" type="submit">Kirim Pesan 🐾</button>
    </form>
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
