![Banner](https://capsule-render.vercel.app/api?type=waving&height=260&color=0:1a0a2e,50:c97d4e,100:f4a261&text=Purrfect%20Community%20Website&fontColor=ffffff&fontSize=46&fontAlignY=38&desc=Website%20Komunitas%20Kucing%20%C2%B7%20PHP%20%C2%B7%20PDO%20%C2%B7%20MySQL&descAlignY=58&animation=fadeIn)

[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Google Fonts](https://img.shields.io/badge/Google_Fonts-Nunito%20%2B%20Playfair-4285F4?style=for-the-badge&logo=google&logoColor=white)](https://fonts.google.com/)
[![Status](https://img.shields.io/badge/Status-Active-f4a261?style=for-the-badge)](https://github.com)

---

## LINK HOSTING
https://purrfect-community.infinityfreeapp.com/
https://purrfect-community.infinityfreeapp.com/admin/
username: admin
password: admin123
---

## 📑 Daftar Isi

- [🎯 Ringkasan Proyek](#-ringkasan-proyek)
- [✨ Fitur Utama](#-fitur-utama)
- [🛠️ Stack Teknologi](#️-stack-teknologi)
- [🗂️ Struktur Folder](#️-struktur-folder)
- [🗃️ Skema Database](#️-skema-database)
- [🧩 Arsitektur Aplikasi](#-arsitektur-aplikasi)
- [🔀 Daftar Halaman & API](#-daftar-halaman--api)
- [🚀 Quick Start](#-quick-start)
- [🧭 Halaman Website](#-halaman-website)
- [📁 Asset & Frontend](#-asset--frontend)
- [⚙️ Konfigurasi Environment](#️-konfigurasi-environment)
- [🧪 Smoke Test](#-smoke-test)
- [📌 Catatan Deployment](#-catatan-deployment)
- [👤 Developer](#-developer)

---

## 🎯 Ringkasan Proyek

**Purrfect Community v2** adalah website komunitas pecinta kucing berbasis **PHP native + PDO + MySQL** yang dibangun dari nol tanpa framework besar. Website ini menjadi ruang digital bagi para *cat lover* di Samarinda dan sekitarnya untuk berbagi informasi, mengenal ras kucing, mengikuti event komunitas, dan terhubung satu sama lain.

Website menyediakan dua lapis konten utama:

- **Halaman Publik** — Dapat diakses siapa saja; menampilkan beranda, galeri ras kucing, daftar favorit, forum komunitas, informasi kontak, dan halaman tentang kami.
- **API Endpoint** — Endpoint ringan berbasis JSON untuk menerima pesan kontak dari pengunjung dan mengelola data favorit berbasis sesi browser.

> **Tujuan Proyek:** Menghadirkan platform digital yang hangat dan informatif bagi komunitas pecinta kucing, sekaligus menjadi portofolio pengembangan web menggunakan PHP murni tanpa ketergantungan pada framework eksternal.

**Fokus pengembangan:**

- **Konten berbasis database** — Semua teks konten halaman diambil dari MySQL, bukan di-hardcode di HTML.
- **Antarmuka responsif dan menarik** — Desain modern dengan palet warna hangat, tipografi elegan, dan tampilan yang nyaman di semua perangkat.
- **Arsitektur minimalis** — Query layer terpusat di `server/queries.php`, tanpa MVC, cocok untuk proyek skala kecil-menengah.
- **Zero dependency berat** — Tidak memerlukan Composer, Node.js, atau framework PHP/JS eksternal.

---

## ✨ Fitur Utama

### 🏠 Beranda (`index.php`)

- Landing page lengkap dengan hero section, hero badge dinamis, dan tombol CTA.
- **Statistik komunitas** (anggota aktif, jumlah ras, postingan forum, tahun berdiri) ditarik langsung dari database.
- **Artikel populer** — 4 artikel unggulan dengan tag kategori, judul, dan deskripsi singkat.
- **Tips merawat kucing** — 4 kartu tips esensial dengan ikon, judul, dan deskripsi.
- **CTA Banner** — Banner ajakan bergabung dengan teks, deskripsi, dan link tombol yang dapat dikonfigurasi dari database.

### 🐱 Galeri Kucing (`galeri.php`)

- Menampilkan koleksi **ras kucing** dengan kartu informatif.
- Setiap kartu berisi: nama ras, asal negara (dengan emoji bendera), deskripsi, kategori (`Lokal` / `Impor`), emoji representasi, dan daftar **traits/karakteristik**.
- Filter interaktif berbasis JavaScript untuk memfilter ras berdasarkan kategori (Semua / Lokal / Impor).
- Data traits dimuat secara efisien menggunakan query `IN (...)` tanpa N+1 problem.

### ★ Favorit (`favorites.php`)

- Halaman koleksi ras kucing favorit milik pengguna.
- Favorit disimpan menggunakan **localStorage** di browser (tanpa akun/login).
- Menampilkan kartu ras beserta nama, emoji, dan opsi untuk menghapus dari daftar favorit.
- Integrasi dengan `api/favorites_local.php` untuk konsistensi semantik tanpa persistensi server-side.

### 💬 Komunitas (`komunitas.php`)

- **Thread forum** — Daftar diskusi aktif dengan kategori, judul, preview pesan, nama author dengan avatar emoji, dan statistik (replies, views, likes).
- **Event mendatang** — Jadwal kegiatan komunitas dengan tanggal, judul, deskripsi, dan tag lokasi (online/offline).
- **Sidebar anggota aktif** — Daftar member dengan nama, avatar, dan jumlah postingan.
- **Tag topik** — Daftar tag topik populer (#Kesehatan, #Grooming, #Adopsi, dll.).

### 📬 Kontak (`kontak.php`)

- Informasi kontak lengkap (email, lokasi, jam operasional, media sosial) diambil dari database.
- **Form kontak interaktif** — Field nama, email, topik, dan isi pesan. Submit via `fetch()` ke `api/contact_message.php`.
- **FAQ Accordion** — Daftar pertanyaan umum yang dapat dibuka-tutup dengan animasi JavaScript.
- Pesan yang dikirim tersimpan di tabel `contact_messages` di database.

### ℹ️ Tentang Kami (`tentang.php`)

- **Hero section** tentang komunitas dengan tag, heading, dan deskripsi.
- **Nilai-nilai komunitas** — 4 kartu nilai (Kasih Sayang, Komunitas Inklusif, Edukasi, Kesejahteraan Hewan).
- **Tim pengurus** — Profil anggota tim dengan nama, peran, bio singkat, avatar emoji, dan informasi kucing peliharaan.
- **Timeline sejarah** — Perjalanan komunitas dari 2022 hingga sekarang ditampilkan dalam format timeline vertikal.

---

## 🛠️ Stack Teknologi

| Kategori | Teknologi |
|---|---|
| **Backend Language** | PHP 8.2+ (native, tanpa framework) |
| **Database Driver** | PDO (PHP Data Objects) dengan MySQL |
| **Database** | MySQL 8.0+ / MariaDB |
| **Arsitektur** | Flat PHP + Query Layer terpusat |
| **Frontend** | HTML5, CSS3 (custom), JavaScript Vanilla |
| **Tipografi** | Google Fonts — Playfair Display + Nunito |
| **Web Server** | Apache (dengan `.htaccess`) |
| **API** | JSON endpoint PHP native (`api/`) |
| **Persistensi Favorit** | localStorage (browser-side) |
| **Session** | Tidak diperlukan — website publik tanpa login |

---

## 🗂️ Struktur Folder

<details>
<summary><strong>📂 Klik untuk memperluas struktur folder lengkap</strong></summary>

```
purrfect-community-v2/
|
+-- index.php               -> Beranda (hero, statistik, artikel, tips, CTA)
+-- galeri.php              -> Galeri ras kucing dengan filter kategori
+-- favorites.php           -> Halaman favorit (localStorage-based)
+-- komunitas.php           -> Forum, event, member, topic tag
+-- kontak.php              -> Info kontak, form pesan, FAQ accordion
+-- tentang.php             -> Tentang komunitas, nilai, tim, timeline
|
+-- api/
|   +-- contact_message.php -> POST endpoint: simpan pesan kontak ke DB
|   +-- favorites_local.php -> Endpoint favorit (local-only, tanpa SQL)
|
+-- server/
|   +-- db.php              -> Koneksi PDO (baca env var / fallback default)
|   +-- http_helpers.php    -> Helper: json_response(), require_method()
|   +-- queries.php         -> Semua fungsi query SQL terpusat
|   +-- schema.sql          -> Skema lengkap + seed data awal
|   +-- setup_db.php        -> Script setup/inisialisasi database
|
+-- css/
|   +-- style.css           -> Stylesheet utama seluruh halaman
|
+-- js/
|   +-- main.js             -> Logic frontend: hamburger nav, filter galeri,
|                              FAQ accordion, form kontak (fetch API)
|
+-- .htaccess               -> Konfigurasi Apache (DirectoryIndex, rewrite)
+-- php_server.log          -> Log PHP built-in server (development)
```

</details>

---

## 🗃️ Skema Database

Database `purrfect` terdiri dari **18 tabel** yang dikelompokkan per halaman.

### Grup: Beranda

```sql
-- Teks badge di hero section
CREATE TABLE hero_badge (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    badge_text  VARCHAR(200) NOT NULL
);

-- Statistik komunitas (anggota, ras, postingan, dll.)
CREATE TABLE stats (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    number_text  VARCHAR(50)  NOT NULL,
    label_text   VARCHAR(100) NOT NULL,
    sort_order   INT NOT NULL DEFAULT 0
);

-- Kartu artikel populer
CREATE TABLE popular_articles (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    tag          VARCHAR(50)  NOT NULL,
    title        VARCHAR(150) NOT NULL,
    description  TEXT         NOT NULL,
    sort_order   INT NOT NULL DEFAULT 0
);

-- Kartu tips merawat kucing
CREATE TABLE tips (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    icon         VARCHAR(10)  NOT NULL,
    title        VARCHAR(80)  NOT NULL,
    description  TEXT         NOT NULL,
    sort_order   INT NOT NULL DEFAULT 0
);

-- Banner CTA (Call-to-Action)
CREATE TABLE cta_banner (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    heading      VARCHAR(150) NOT NULL,
    description  TEXT         NOT NULL,
    button_text  VARCHAR(100) NOT NULL,
    button_href  VARCHAR(200) NOT NULL
);
```

### Grup: Galeri

```sql
-- Data ras kucing
CREATE TABLE cat_races (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100) NOT NULL,
    origin      VARCHAR(80)  NOT NULL,
    description TEXT         NOT NULL,
    category    ENUM('Lokal','Impor') NOT NULL,
    emoji       VARCHAR(10)  NOT NULL,
    color_bg    VARCHAR(20)  NOT NULL,
    sort_order  INT NOT NULL DEFAULT 0
);

-- Karakteristik/traits per ras (relasi one-to-many)
CREATE TABLE cat_race_traits (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    race_id    INT         NOT NULL,
    trait      VARCHAR(60) NOT NULL,
    sort_order INT NOT NULL DEFAULT 0,
    CONSTRAINT fk_race_traits FOREIGN KEY (race_id)
        REFERENCES cat_races(id) ON DELETE CASCADE ON UPDATE CASCADE
);
```

### Grup: Komunitas

```sql
-- Anggota aktif (sidebar)
CREATE TABLE members (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(80)  NOT NULL,
    avatar_emoji  VARCHAR(10)  NOT NULL,
    avatar_bg     VARCHAR(20)  NOT NULL,
    posts_count   INT NOT NULL DEFAULT 0,
    sort_order    INT NOT NULL DEFAULT 0
);

-- Thread diskusi forum
CREATE TABLE forum_threads (
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    category            VARCHAR(60)  NOT NULL,
    title               VARCHAR(160) NOT NULL,
    author              VARCHAR(80)  NOT NULL,
    author_avatar_emoji VARCHAR(10)  NOT NULL,
    author_avatar_bg    VARCHAR(20)  NOT NULL,
    published_text      VARCHAR(60)  NOT NULL,
    preview             TEXT         NOT NULL,
    replies_count       INT NOT NULL DEFAULT 0,
    views_count         INT NOT NULL DEFAULT 0,
    likes_count         INT NOT NULL DEFAULT 0,
    sort_order          INT NOT NULL DEFAULT 0
);

-- Jadwal event komunitas
CREATE TABLE events (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    event_date  VARCHAR(50)  NOT NULL,
    title       VARCHAR(140) NOT NULL,
    description TEXT         NOT NULL,
    tag         VARCHAR(80)  NOT NULL,
    sort_order  INT NOT NULL DEFAULT 0
);

-- Tag topik diskusi
CREATE TABLE topic_tags (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    tag        VARCHAR(40) NOT NULL,
    sort_order INT NOT NULL DEFAULT 0
);
```

### Grup: Kontak

```sql
-- Informasi kontak & media sosial (satu baris)
CREATE TABLE contact_info (
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    email_primary       VARCHAR(120) NOT NULL,
    email_secondary     VARCHAR(120) NOT NULL,
    location            VARCHAR(150) NOT NULL,
    hours_weekdays      VARCHAR(150) NOT NULL,
    hours_saturday      VARCHAR(150) NOT NULL,
    social_instagram    VARCHAR(200) NOT NULL,
    social_whatsapp     VARCHAR(200) NOT NULL,
    social_youtube      VARCHAR(200) NOT NULL,
    social_tiktok       VARCHAR(200) NOT NULL
);

-- Pertanyaan yang Sering Diajukan
CREATE TABLE faqs (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    question   VARCHAR(200) NOT NULL,
    answer     TEXT         NOT NULL,
    sort_order INT NOT NULL DEFAULT 0
);

-- Pesan masuk dari form kontak
CREATE TABLE contact_messages (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    email      VARCHAR(120) NOT NULL,
    topic      VARCHAR(120) NOT NULL,
    message    TEXT         NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
```

### Grup: Tentang Kami

```sql
CREATE TABLE about_hero (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    tag         VARCHAR(80)  NOT NULL,
    heading     VARCHAR(180) NOT NULL,
    description TEXT         NOT NULL
);

CREATE TABLE `values` (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    icon        VARCHAR(10)  NOT NULL,
    title       VARCHAR(100) NOT NULL,
    description TEXT         NOT NULL,
    sort_order  INT NOT NULL DEFAULT 0
);

CREATE TABLE team_members (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(120) NOT NULL,
    role          VARCHAR(120) NOT NULL,
    bio           TEXT         NOT NULL,
    avatar_emoji  VARCHAR(10)  NOT NULL,
    avatar_bg     VARCHAR(20)  NOT NULL,
    cats_text     TEXT         NOT NULL,
    sort_order    INT NOT NULL DEFAULT 0
);

CREATE TABLE timeline_items (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    year        VARCHAR(20)  NOT NULL,
    event       VARCHAR(140) NOT NULL,
    description TEXT         NOT NULL,
    dot_emoji   VARCHAR(10)  NOT NULL,
    sort_order  INT NOT NULL DEFAULT 0
);
```

---

## 🧩 Arsitektur Aplikasi

Aplikasi menggunakan pola **Flat PHP + Centralized Query Layer** — sederhana, transparan, dan tanpa overhead framework.

```
HTTP Request
     |
     v
[Halaman PHP]  (index.php, galeri.php, komunitas.php, ...)
     |
     +---> server/queries.php       <- Semua fungsi query SQL terpusat
     |           |
     |           v
     |     server/db.php            <- Koneksi PDO ke MySQL
     |
     +---> [Render HTML]            <- Output langsung via PHP template
     |
     v
[API Endpoint] (api/contact_message.php)
     |
     +---> server/http_helpers.php  <- Helper: json_response(), require_method()
     +---> server/db.php            <- Koneksi PDO (shared)
     +---> [JSON Response]          <- Output JSON ke browser
```

### Komponen Server

| File | Peran |
|---|---|
| `server/db.php` | Membuat koneksi `PDO` ke MySQL; membaca konfigurasi dari environment variable dengan fallback ke nilai default |
| `server/queries.php` | Berisi semua fungsi query (`get_stats()`, `get_cat_races()`, `get_forum_threads()`, dll.) — satu-satunya tempat SQL ditulis |
| `server/http_helpers.php` | Helper ringan untuk API: `json_response()` dan `require_method()` |
| `server/schema.sql` | Skema lengkap DDL + seed data awal untuk semua tabel |
| `server/setup_db.php` | Script setup mandiri untuk inisialisasi database |

### Pola Query — Efisiensi N+1

Untuk data traits per ras kucing, digunakan pendekatan batch query daripada query per-item:

```php
// Ambil semua race ID sekaligus
$raceIds = array_map(fn($r) => (int)$r['id'], $catRaces);

// Satu query dengan IN (...) — bukan N query
$traitsByRaceId = get_cat_race_traits_by_race_ids($raceIds);
```

---

## 🔀 Daftar Halaman & API

### Halaman Publik

| File | Path | Sumber Data | Keterangan |
|---|---|---|---|
| `index.php` | `/` | `hero_badge`, `stats`, `popular_articles`, `tips`, `cta_banner` | Landing page utama |
| `galeri.php` | `/galeri.php` | `cat_races`, `cat_race_traits` | Galeri ras kucing + filter |
| `favorites.php` | `/favorites.php` | `cat_races` (read-only) | Koleksi favorit (localStorage) |
| `komunitas.php` | `/komunitas.php` | `forum_threads`, `events`, `members`, `topic_tags` | Forum & event komunitas |
| `kontak.php` | `/kontak.php` | `contact_info`, `faqs` | Info kontak & FAQ |
| `tentang.php` | `/tentang.php` | `about_hero`, `values`, `team_members`, `timeline_items` | Profil komunitas |

### API Endpoint

| Method | Path | Keterangan |
|---|---|---|
| `POST` | `/api/contact_message.php` | Terima pesan kontak (JSON body), validasi, simpan ke `contact_messages` |
| `GET/POST` | `/api/favorites_local.php` | Endpoint favorit — tanpa SQL, persistensi di localStorage browser |

---

## 🚀 Quick Start

<details>
<summary><strong>⚙️ Klik untuk instruksi instalasi lengkap</strong></summary>

### Prasyarat

- PHP 8.2 atau lebih baru
- MySQL 8.0+ atau MariaDB
- Apache dengan `mod_rewrite` aktif **atau** PHP built-in server untuk development

### 1. Clone / Ekstrak Repository

```bash
git clone https://github.com/sayidrafi/purrfect-community-v2.git
cd purrfect-community-v2
```

### 2. Setup Database

**Opsi A — Import SQL langsung (direkomendasikan):**

```bash
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS purrfect CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root -p purrfect < server/schema.sql
```

**Opsi B — Via script setup:**

```bash
php server/setup_db.php
```

### 3. Konfigurasi Koneksi Database

Edit `server/db.php` atau set environment variable:

```bash
export DB_HOST=localhost
export DB_NAME=purrfect
export DB_USER=root
export DB_PASS=your_password
```

Atau langsung edit nilai default di `server/db.php`:

```php
$DB_HOST = getenv('DB_HOST') ?: 'localhost';
$DB_NAME = getenv('DB_NAME') ?: 'purrfect';
$DB_USER = getenv('DB_USER') ?: 'root';
$DB_PASS = getenv('DB_PASS') ?: '';
```

### 4. Jalankan Aplikasi

**PHP built-in server (development):**

```bash
php -S 127.0.0.1:8080
```

**XAMPP / Laragon:**
Arahkan document root ke folder `purrfect-community-v2/`.

### 5. Akses di Browser

```
Beranda      : http://127.0.0.1:8080/
Galeri       : http://127.0.0.1:8080/galeri.php
Komunitas    : http://127.0.0.1:8080/komunitas.php
Kontak       : http://127.0.0.1:8080/kontak.php
Tentang Kami : http://127.0.0.1:8080/tentang.php
Favorit      : http://127.0.0.1:8080/favorites.php
```

</details>

---

## 🧭 Halaman Website

| Halaman | File | Data Utama | Fungsi |
|---|---|---|---|
| **Beranda** | `index.php` | Statistik, artikel, tips, CTA | Landing page & overview komunitas |
| **Galeri Kucing** | `galeri.php` | Ras kucing + traits | Showcase ras dengan filter kategori |
| **Favorit** | `favorites.php` | Data ras (read) | Koleksi ras favorit pengguna |
| **Komunitas** | `komunitas.php` | Thread, event, member, tag | Forum diskusi & jadwal kegiatan |
| **Kontak** | `kontak.php` | Info kontak, FAQ | Formulir pesan & info organisasi |
| **Tentang Kami** | `tentang.php` | Hero, values, tim, timeline | Profil & sejarah komunitas |

---

## 📁 Asset & Frontend

### CSS

| File | Fungsi |
|---|---|
| `css/style.css` | Stylesheet utama — layout, tipografi, komponen kartu, nav, footer, responsif |

**Palet Warna Utama:**
- Oranye hangat `#f4a261` — warna aksen utama
- Krem lembut `#fff8f0` — background section
- Coklat gelap `#1a0a2e` — teks heading utama

### JavaScript

| File | Fungsi |
|---|---|
| `js/main.js` | Hamburger menu mobile, filter galeri (Lokal/Impor), toggle favorit (localStorage), FAQ accordion, form kontak via `fetch()` API |

### Tipografi (Google Fonts CDN)

- **Playfair Display** (600, 700) — heading dan nama brand
- **Nunito** (400, 500, 600, 700) — body text dan UI

---

## ⚙️ Konfigurasi Environment

Koneksi database dibaca dari **environment variable** dengan nilai fallback:

| Variable | Default | Keterangan |
|---|---|---|
| `DB_HOST` | `localhost` | Host server MySQL |
| `DB_NAME` | `purrfect` | Nama database |
| `DB_USER` | `root` | Username database |
| `DB_PASS` | _(kosong)_ | Password database |

Charset selalu `utf8mb4` dan mode koneksi selalu `PDO::ERRMODE_EXCEPTION`.

---

## 🧪 Smoke Test

### Syntax Check (PHP Linting)

```bash
# Cek semua file PHP sekaligus
find . -name "*.php" -not -path "./server/setup_db.php" -exec php -l {} \;
```

### Smoke Test Endpoint

```
# Halaman Publik
GET /                        -> 200 OK, hero + artikel + tips tampil
GET /galeri.php              -> 200 OK, kartu ras kucing tampil dengan filter
GET /favorites.php           -> 200 OK, halaman favorit (kosong atau berisi)
GET /komunitas.php           -> 200 OK, thread + event + sidebar tampil
GET /kontak.php              -> 200 OK, form + FAQ accordion tampil
GET /tentang.php             -> 200 OK, hero + tim + timeline tampil

# API Endpoint
POST /api/contact_message.php  (JSON body valid)    -> 201 Created
POST /api/contact_message.php  (field kosong)       -> 422 Unprocessable
POST /api/contact_message.php  (email tidak valid)  -> 422 Unprocessable
GET  /api/contact_message.php                       -> 405 Method Not Allowed
```

---

## 📌 Catatan Deployment

### Hosting Shared (cPanel / InfinityFree / Niagahoster)

1. Upload seluruh isi folder ke `public_html/` atau subdirektori yang diinginkan.
2. Import database via phpMyAdmin menggunakan file `server/schema.sql`.
3. Set environment variable via cPanel atau edit langsung nilai default di `server/db.php`.
4. Pastikan `mod_rewrite` aktif (biasanya sudah aktif di cPanel).

### VPS (Nginx)

```nginx
server {
    listen 80;
    server_name purrfect-community.com;
    root /var/www/purrfect-community-v2;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

### Checklist Produksi

- [ ] Ganti nilai default DB di `server/db.php` atau set via environment variable server
- [ ] Verifikasi semua halaman dan endpoint merespons dengan benar
- [ ] Aktifkan HTTPS (SSL/TLS)
- [ ] Pastikan `php_server.log` tidak dapat diakses publik

---

## 👤 Developer

| Nama | NIM |
|---|---|
| **Sayid Rafi A'thaya** | 2409116036 |

---

<div align="center">

![Footer](https://capsule-render.vercel.app/api?type=waving&height=120&color=0:f4a261,100:1a0a2e&section=footer)

**Purrfect Community v2** &nbsp;·&nbsp; Dibangun oleh Sayid Rafi A'thaya

</div>
