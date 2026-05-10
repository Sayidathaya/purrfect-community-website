-- MySQL schema for Purrfect Community
-- Run: SOURCE server/schema.sql;

CREATE DATABASE IF NOT EXISTS purrfect CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE purrfect;

-- 1) INDEX (stats + articles + tips + cta + hero badge)
CREATE TABLE IF NOT EXISTS stats (
  id INT AUTO_INCREMENT PRIMARY KEY,
  number_text VARCHAR(50) NOT NULL,
  label_text VARCHAR(100) NOT NULL,
  sort_order INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS hero_badge (
  id INT AUTO_INCREMENT PRIMARY KEY,
  badge_text VARCHAR(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS popular_articles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tag VARCHAR(50) NOT NULL,
  title VARCHAR(150) NOT NULL,
  description TEXT NOT NULL,
  sort_order INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS tips (
  id INT AUTO_INCREMENT PRIMARY KEY,
  icon VARCHAR(10) NOT NULL,
  title VARCHAR(80) NOT NULL,
  description TEXT NOT NULL,
  sort_order INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cta_banner (
  id INT AUTO_INCREMENT PRIMARY KEY,
  heading VARCHAR(150) NOT NULL,
  description TEXT NOT NULL,
  button_text VARCHAR(100) NOT NULL,
  button_href VARCHAR(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2) GALERI (kucing ras + filter)
CREATE TABLE IF NOT EXISTS cat_races (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  origin VARCHAR(80) NOT NULL,
  description TEXT NOT NULL,
  category ENUM('Lokal','Impor') NOT NULL,
  emoji VARCHAR(10) NOT NULL,
  color_bg VARCHAR(20) NOT NULL,
  sort_order INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cat_race_traits (
  id INT AUTO_INCREMENT PRIMARY KEY,
  race_id INT NOT NULL,
  trait VARCHAR(60) NOT NULL,
  sort_order INT NOT NULL DEFAULT 0,
  CONSTRAINT fk_race_traits FOREIGN KEY (race_id) REFERENCES cat_races(id)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3) KOMUNITAS (threads + events + members + topic tags)
CREATE TABLE IF NOT EXISTS members (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(80) NOT NULL,
  avatar_emoji VARCHAR(10) NOT NULL,
  avatar_bg VARCHAR(20) NOT NULL,
  posts_count INT NOT NULL DEFAULT 0,
  sort_order INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS forum_threads (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category VARCHAR(60) NOT NULL,
  title VARCHAR(160) NOT NULL,
  author VARCHAR(80) NOT NULL,
  author_avatar_emoji VARCHAR(10) NOT NULL,
  author_avatar_bg VARCHAR(20) NOT NULL,
  published_text VARCHAR(60) NOT NULL, -- e.g. "2 jam lalu"
  preview TEXT NOT NULL,
  replies_count INT NOT NULL DEFAULT 0,
  views_count INT NOT NULL DEFAULT 0,
  likes_count INT NOT NULL DEFAULT 0,
  sort_order INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  event_date VARCHAR(50) NOT NULL,
  title VARCHAR(140) NOT NULL,
  description TEXT NOT NULL,
  tag VARCHAR(80) NOT NULL,
  sort_order INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS topic_tags (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tag VARCHAR(40) NOT NULL,
  sort_order INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4) KONTAK (company contact, faq)
CREATE TABLE IF NOT EXISTS contact_info (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email_primary VARCHAR(120) NOT NULL,
  email_secondary VARCHAR(120) NOT NULL,
  location VARCHAR(150) NOT NULL,
  hours_weekdays VARCHAR(150) NOT NULL,
  hours_saturday VARCHAR(150) NOT NULL,
  social_instagram VARCHAR(200) NOT NULL,
  social_whatsapp VARCHAR(200) NOT NULL,
  social_youtube VARCHAR(200) NOT NULL,
  social_tiktok VARCHAR(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS faqs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question VARCHAR(200) NOT NULL,
  answer TEXT NOT NULL,
  sort_order INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS contact_messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(120) NOT NULL,
  topic VARCHAR(120) NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5) TENTANG (about hero + values + team + timeline)
CREATE TABLE IF NOT EXISTS about_hero (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tag VARCHAR(80) NOT NULL,
  heading VARCHAR(180) NOT NULL,
  description TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `values` (
  id INT AUTO_INCREMENT PRIMARY KEY,
  icon VARCHAR(10) NOT NULL,
  title VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  sort_order INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS team_members (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  role VARCHAR(120) NOT NULL,
  bio TEXT NOT NULL,
  avatar_emoji VARCHAR(10) NOT NULL,
  avatar_bg VARCHAR(20) NOT NULL,
  cats_text TEXT NOT NULL,
  sort_order INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS timeline_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  year VARCHAR(20) NOT NULL,
  event VARCHAR(140) NOT NULL,
  description TEXT NOT NULL,
  dot_emoji VARCHAR(10) NOT NULL,
  sort_order INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================
-- Seed dummy data
-- =========================

-- hero badge + stats
INSERT INTO hero_badge (id, badge_text) VALUES (1, '🐾 Komunitas Pecinta Kucing #1 Kalimantan Timur');

INSERT INTO stats (id, number_text, label_text, sort_order) VALUES
(1, '2.4K+', 'Anggota Aktif', 1),
(2, '18+', 'Ras Kucing', 2),
(3, '500+', 'Postingan Forum', 3),
(4, '3 Tahun', 'Berdiri Sejak 2022', 4);

-- popular articles (4 items)
INSERT INTO popular_articles (id, tag, title, description, sort_order) VALUES
(1, 'Nutrisi', 'Panduan Lengkap Nutrisi Kucing Peliharaan', 'Mengenal kebutuhan gizi kucing agar tetap sehat, aktif, dan berumur panjang.', 1),
(2, 'Kesehatan', 'Tanda Kucing Sakit yang Wajib Dikenali', 'Kenali gejala awal penyakit pada kucing sebelum terlambat ditangani.', 2),
(3, 'Perilaku', 'Mengapa Kucing Suka Mendengkur?', 'Terungkap makna di balik dengkuran si meong yang bikin hati luluh.', 3),
(4, 'Grooming', 'Cara Memandikan Kucing Anti Stres', 'Tips dan trik memandikan kucing agar tidak panik dan tetap aman.', 4);

-- tips (4 items)
INSERT INTO tips (id, icon, title, description, sort_order) VALUES
(1, '💧', 'Hidrasi Cukup', 'Pastikan kucing selalu memiliki akses ke air bersih. Kucing cenderung malas minum, gunakan air mancur kucing untuk mendorong mereka minum lebih banyak.', 1),
(2, '🪮', 'Sisir Rutin', 'Menyisir bulu kucing minimal 3x seminggu membantu mengurangi hairball dan menjaga bulu tetap bersih serta bebas kusut.', 2),
(3, '🎾', 'Waktu Bermain', 'Luangkan minimal 15–20 menit sehari untuk bermain bersama kucing. Ini penting untuk stimulasi mental dan mencegah stres.', 3),
(4, '💉', 'Vaksinasi Tepat Waktu', 'Vaksinasi rutin melindungi kucing dari penyakit berbahaya. Konsultasikan jadwal vaksin dengan dokter hewan terpercaya.', 4);

-- CTA banner
INSERT INTO cta_banner (id, heading, description, button_text, button_href) VALUES
(1,
 'Bergabunglah dengan Ribuan Cat Lover! 🐾',
 'Daftarkan dirimu dan mulai berbagi cerita dengan komunitas kami yang hangat dan penuh cinta kucing.',
 'Daftar Sekarang – Gratis!',
 'komunitas.html'
);

-- galeri cat races
INSERT INTO cat_races (id, name, origin, description, category, emoji, color_bg, sort_order) VALUES
(1, 'Kucing Kampung', '🇮🇩 Indonesia', 'Kucing yang cerdas, tangguh, dan mudah beradaptasi. Dikenal dengan daya tahan tubuhnya yang luar biasa di iklim tropis.', 'Lokal', '🐈', '#FFF9F0', 1),
(2, 'Persian', '🇮🇷 Persia / Iran', 'Kucing berbulu panjang dan lebat dengan wajah datar yang khas. Dikenal sangat tenang, anggun, dan senang dimanjakan.', 'Impor', '😸', '#F0F7FF', 2),
(3, 'Maine Coon', '🇺🇸 Amerika Serikat', 'Salah satu ras kucing terbesar di dunia dengan bulu tebal panjang dan ekor lebat. Kepribadiannya seperti anjing – setia dan suka bermain.', 'Impor', '🐱', '#F5FFF5', 3),
(4, 'Scottish Fold', '🏴 Skotlandia', 'Terkenal dengan telinga yang melipat ke depan, menciptakan ekspresi menggemaskan. Sangat sosial dan ramah dengan semua anggota keluarga.', 'Impor', '😺', '#FFF5F5', 4),
(5, 'Siamese', '🇹🇭 Thailand', 'Kucing oriental yang elegan dengan warna tubuh kontras dan mata biru memesona. Dikenal vokal, cerdas, dan sangat ekspresif.', 'Impor', '🐈‍⬛', '#FFFBF0', 5),
(6, 'British Shorthair', '🇬🇧 Inggris', 'Kucing gempal dengan bulu pendek lebat dan wajah bulat yang menggemaskan. Sifatnya tenang, santai, dan tidak terlalu demanding.', 'Impor', '🐾', '#F5F0FF', 6),
(7, 'Ragdoll', '🇺🇸 Amerika Serikat', 'Kucing besar berbulu panjang yang dikenal lemas dan tenang saat digendong, seolah seperti boneka. Sangat cocok untuk keluarga dengan anak-anak.', 'Impor', '🐈', '#FFF0FB', 7),
(8, 'Anggora Lokal', '🇮🇩 Indonesia', 'Varian Anggora yang telah berkembang di Indonesia. Berbulu panjang, lembut, dan sangat manja kepada pemiliknya.', 'Lokal', '🐈', '#F0FBFF', 8);

-- traits (bisa dipakai untuk filter bulu panjang/pendek)
INSERT INTO cat_race_traits (id, race_id, trait, sort_order) VALUES
-- Kampung
(1, 1, 'Mandiri', 1),
(2, 1, 'Cerdas', 2),
(3, 1, 'Tahan Banting', 3),

-- Persian
(4, 2, 'Bulu Panjang', 1),
(5, 2, 'Penyayang', 2),
(6, 2, 'Tenang', 3),

-- Maine Coon
(7, 3, 'Bulu Panjang', 1),
(8, 3, 'Playful', 2),
(9, 3, 'Setia', 3),

-- Scottish Fold
(10, 4, 'Ramah', 1),
(11, 4, 'Adaptif', 2),
(12, 4, 'Menggemaskan', 3),

-- Siamese
(13, 5, 'Vokal', 1),
(14, 5, 'Cerdas', 2),
(15, 5, 'Bulu Pendek', 3),

-- British
(16, 6, 'Bulu Pendek', 1),
(17, 6, 'Santai', 2),
(18, 6, 'Mandiri', 3),

-- Ragdoll
(19, 7, 'Bulu Panjang', 1),
(20, 7, 'Lembut', 2),
(21, 7, 'Sosial', 3),

-- Anggora
(22, 8, 'Bulu Panjang', 1),
(23, 8, 'Manja', 2),
(24, 8, 'Lembut', 3);

-- members sidebar
INSERT INTO members (id, name, avatar_emoji, avatar_bg, posts_count, sort_order) VALUES
(1, 'Rina_Samarinda', '🧑', '#FFF1E6', 342, 1),
(2, 'Dewi_Catmom', '👩', '#F0FFF4', 289, 2),
(3, 'Budi_Kutai', '🧔', '#F5F0FF', 201, 3),
(4, 'Sari_Catrescue', '👩‍🦱', '#FFFBF0', 178, 4);

-- forum threads
INSERT INTO forum_threads
(id, category, title, author, author_avatar_emoji, author_avatar_bg, published_text, preview, replies_count, views_count, likes_count, sort_order)
VALUES
(1, 'Kesehatan', 'Kucingku tidak mau makan sejak 2 hari, ada yang punya pengalaman?', 'Rina_Samarinda', '🧑', '#FFF1E6', '2 jam lalu',
 'Halo semua, kucing Persian saya tiba-tiba mogok makan sejak kemarin. Sudah saya coba ganti mereknya tapi tetap tidak mau...', 14, 82, 7, 1),
(2, 'Grooming', 'Rekomendasi pet groomer di Samarinda yang terpercaya?', 'Dewi_Catmom', '👩', '#F0FFF4', '5 jam lalu',
 'Teman-teman ada rekomendasi groomer yang bagus dan sabar untuk kucing Maine Coon yang bulunya panjang? Di area Samarinda Kota atau Ilir...', 22, 156, 18, 2),
(3, 'Tips & Trik', 'Share foto kucing di atas lemari — mengapa mereka suka tempat tinggi?', 'Budi_Kutai', '🧔', '#F5F0FF', '1 hari lalu',
 'Ini sudah fenomena umum ya, kucing selalu cari tempat paling tinggi di rumah. Ternyata ada alasan ilmiahnya lho! Saya share artikelnya...', 9, 207, 34, 3),
(4, 'Adopsi', 'Ada 3 anak kucing siap diadopsi gratis, umur 2 bulan!', 'Sari_Catrescue', '👩‍🦱', '#FFFBF0', '2 hari lalu',
 'Halo para cat lover! Saya punya 3 anak kucing campuran yang lahir 8 minggu lalu dan butuh rumah hangat. Sudah divaksin pertama dan diobatin kutu...', 47, 412, 89, 4);

-- events
INSERT INTO events (id, event_date, title, description, tag, sort_order) VALUES
(1, '📅 15 Mei 2025', 'Kopdar Cat Lovers Samarinda', 'Pertemuan rutin bulanan para pecinta kucing di Samarinda. Sharing tips, foto bareng kucing, dan banyak doorprize!', '📍 Offline – Samarinda', 1),
(2, '📅 20 Mei 2025', 'Webinar: Kesehatan Kucing Tropical', 'Diskusi virtual bersama drh. Anita tentang cara merawat kucing di iklim tropis panas seperti Kalimantan.', '💻 Online – Zoom', 2),
(3, '📅 1 Juni 2025', 'Cat Photo Contest 2025', 'Kontes foto kucing berhadiah total Rp 3 juta! Kirimkan foto terbaik kucingmu dan menangkan hadiahnya.', '🏆 Kontes – Hadiah Menarik', 3),
(4, '📅 10 Juni 2025', 'Workshop Grooming Mandiri', 'Belajar cara grooming kucing sendiri di rumah bersama ahlinya. Kapasitas terbatas, daftar segera!', '🎓 Workshop – Offline', 4);

-- topic tags
INSERT INTO topic_tags (id, tag, sort_order) VALUES
(1, '#Kesehatan', 1),
(2, '#Grooming', 2),
(3, '#Adopsi', 3),
(4, '#Nutrisi', 4),
(5, '#Persian', 5),
(6, '#Kitten', 6),
(7, '#TipsRawat', 7),
(8, '#MaineCoon', 8),
(9, '#Vaksin', 9);

-- contact info (single row id=1)
INSERT INTO contact_info
(id, email_primary, email_secondary, location, hours_weekdays, hours_saturday, social_instagram, social_whatsapp, social_youtube, social_tiktok)
VALUES
(1, 'hello@purrfect.id', 'admin@purrfect.id', 'Samarinda, Kalimantan Timur Indonesia 75123',
 'Senin – Jumat: 08.00 – 17.00 WITA', 'Sabtu: 09.00 – 13.00 WITA',
 '#', '#', '#', '#');

-- FAQs
INSERT INTO faqs (id, question, answer, sort_order) VALUES
(1, 'Bagaimana cara bergabung dengan komunitas?', 'Kamu bisa bergabung dengan mengisi formulir kontak di atas atau langsung DM kami di Instagram. Keanggotaan sepenuhnya GRATIS dan terbuka untuk semua pecinta kucing!', 1),
(2, 'Apakah ada biaya keanggotaan?', 'Tidak ada sama sekali! Purrfect Community adalah komunitas sosial yang sepenuhnya gratis. Kami bergerak atas dasar kecintaan terhadap kucing.', 2),
(3, 'Bagaimana cara mengiklankan produk kucing saya?', 'Kami membuka peluang sponsorship dan kolaborasi untuk produk-produk yang berkaitan dengan perawatan hewan. Silakan hubungi kami melalui email untuk diskusi lebih lanjut.', 3),
(4, 'Apakah Purrfect Community juga aktif secara offline?', 'Ya! Kami rutin mengadakan kopdar, workshop, dan event fotografi di Samarinda. Pantau terus halaman Komunitas untuk info event terbaru.', 4),
(5, 'Bagaimana cara mendaftarkan kucing untuk program adopsi?', 'Kirim pesan melalui formulir di atas dengan memilih topik "Adopsi Kucing", atau hubungi kami langsung via WhatsApp. Kami akan memandu prosesnya secara gratis.', 5);

-- about hero
INSERT INTO about_hero (id, tag, heading, description) VALUES
(1, 'Kisah Kami', 'Kami Adalah Para<br>Pencinta Kucing Sejati', 'Purrfect Community lahir dari cinta sederhana terhadap makhluk berbulu yang selalu bisa membuat hari terasa lebih hangat.');

-- values
INSERT INTO `values` (id, icon, title, description, sort_order) VALUES
(1, '❤️', 'Kasih Sayang', 'Kami percaya bahwa setiap kucing berhak mendapatkan cinta dan perawatan terbaik. Kasih sayang adalah fondasi dari segala yang kami lakukan.', 1),
(2, '🤝', 'Komunitas Inklusif', 'Semua orang disambut hangat, baik yang baru memiliki kucing pertama maupun yang sudah lama menjadi cat breeder profesional.', 2),
(3, '📚', 'Edukasi Berkelanjutan', 'Kami berkomitmen untuk terus berbagi informasi yang akurat, ilmiah, dan bermanfaat tentang kesehatan dan perawatan kucing.', 3),
(4, '🌱', 'Kesejahteraan Hewan', 'Kami aktif mendukung program adopsi dan sterilisasi untuk mengurangi jumlah kucing terlantar di lingkungan kita.', 4);

-- team
INSERT INTO team_members (id, name, role, bio, avatar_emoji, avatar_bg, cats_text, sort_order) VALUES
(1, 'Dina Rahmawati', 'Ketua Komunitas',
 'Pecinta kucing sejak kecil, kini memiliki 4 ekor kucing Persian di rumahnya. Aktif dalam kampanye adopt don''t shop.',
 '👩', '#FFF1E6', '🐱 Peliharaan: Luna, Bintang, Salju, Mochi', 1),
(2, 'Ardi Santoso', 'Koordinator Event',
 'Seorang fotografer yang jatuh cinta pada kucing Maine Coon. Bertanggung jawab atas semua kegiatan offline komunitas.',
 '🧔', '#F0FFF4', '🐱 Peliharaan: Thor, Freya', 2),
(3, 'Siska Lestari', 'Admin Media Sosial',
 'Mahasiswi desain komunikasi visual yang mengelola konten dan tampilan media sosial Purrfect Community.',
 '👩‍🦱', '#F5F0FF', '🐱 Peliharaan: Oreo, Cookies', 3),
(4, 'drh. Bimo Pratama', 'Konsultan Kesehatan',
 'Dokter hewan yang aktif menjawab pertanyaan seputar kesehatan kucing di forum komunitas dan acara webinar kami.',
 '🧑‍⚕️', '#FFFBF0', '🐱 Peliharaan: Miso, Ramen, Udon', 4);

-- timeline items
INSERT INTO timeline_items (id, year, event, description, dot_emoji, sort_order) VALUES
(1, '2022', 'Komunitas Terbentuk', '8 orang pecinta kucing bertemu di sebuah kafe di Samarinda dan memutuskan untuk membentuk komunitas resmi.', '🌱', 1),
(2, '2023', '500 Anggota & Kopdar Perdana', 'Milestone 500 anggota tercapai. Kopdar offline pertama dihadiri 60 orang beserta kucing-kucing mereka!', '🎉', 2),
(3, '2024', 'Program Adopsi & Website Resmi', 'Meluncurkan program adopsi yang telah membantu lebih dari 80 kucing menemukan rumah baru yang penuh kasih sayang.', '🏠', 3),
(4, '2025', '2.400+ Anggota & Terus Berkembang', 'Kini menjadi komunitas kucing terbesar di Kalimantan Timur dengan berbagai program rutin dan event tahunan.', '🚀', 4);
