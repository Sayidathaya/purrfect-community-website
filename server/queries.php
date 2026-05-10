<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';

function fetch_one(string $sql, array $params = []): ?array {
  global $pdo;
  $stmt = $pdo->prepare($sql);
  $stmt->execute($params);
  $row = $stmt->fetch();
  return $row ?: null;
}

function fetch_all(string $sql, array $params = []): array {
  global $pdo;
  $stmt = $pdo->prepare($sql);
  $stmt->execute($params);
  return $stmt->fetchAll();
}

function get_hero_badge(): string {
  $row = fetch_one('SELECT badge_text FROM hero_badge ORDER BY id ASC LIMIT 1');
  return $row ? (string)$row['badge_text'] : '';
}

function get_stats(): array {
  return fetch_all(
    'SELECT number_text, label_text FROM stats ORDER BY sort_order ASC, id ASC',
  );
}

function get_popular_articles(): array {
  return fetch_all(
    'SELECT tag, title, description FROM popular_articles ORDER BY sort_order ASC, id ASC',
  );
}

function get_tips(): array {
  return fetch_all(
    'SELECT icon, title, description FROM tips ORDER BY sort_order ASC, id ASC',
  );
}

function get_cta_banner(): ?array {
  return fetch_one(
    'SELECT heading, description, button_text, button_href FROM cta_banner ORDER BY id ASC LIMIT 1'
  );
}

// GALERI
function get_cat_races(): array {
  return fetch_all(
    'SELECT id, name, origin, description, category, emoji, color_bg FROM cat_races ORDER BY sort_order ASC, id ASC'
  );
}

function get_cat_race_traits_by_race_ids(array $raceIds): array {
  if ($raceIds === []) return [];
  $placeholders = implode(',', array_fill(0, count($raceIds), '?'));

  $rows = fetch_all(
    "SELECT race_id, trait FROM cat_race_traits WHERE race_id IN ($placeholders) ORDER BY sort_order ASC, id ASC",
    array_values($raceIds)
  );

  $byRaceId = [];
  foreach ($rows as $row) {
    $raceId = (int)$row['race_id'];
    if (!isset($byRaceId[$raceId])) $byRaceId[$raceId] = [];
    $byRaceId[$raceId][] = (string)$row['trait'];
  }
  return $byRaceId;
}

// KOMUNITAS
function get_members(): array {
  return fetch_all(
    'SELECT name, avatar_emoji, avatar_bg, posts_count FROM members ORDER BY sort_order ASC, id ASC'
  );
}

function get_forum_threads(): array {
  return fetch_all(
    'SELECT category, title, author, author_avatar_emoji, author_avatar_bg, published_text, preview, replies_count, views_count, likes_count
     FROM forum_threads
     ORDER BY sort_order ASC, id ASC'
  );
}

function get_events(): array {
  return fetch_all(
    'SELECT event_date, title, description, tag FROM events ORDER BY sort_order ASC, id ASC'
  );
}

function get_topic_tags(): array {
  return fetch_all(
    'SELECT tag FROM topic_tags ORDER BY sort_order ASC, id ASC'
  );
}

// TENTANG
function get_about_hero(): array {
  $row = fetch_one('SELECT tag, heading, description FROM about_hero ORDER BY id ASC LIMIT 1');
  return $row ? $row : ['tag' => '', 'heading' => '', 'description' => ''];
}

function get_values(): array {
  return fetch_all(
    'SELECT icon, title, description FROM `values` ORDER BY sort_order ASC, id ASC'
  );
}

function get_team_members(): array {
  return fetch_all(
    'SELECT name, role, bio, avatar_emoji, avatar_bg, cats_text FROM team_members ORDER BY sort_order ASC, id ASC'
  );
}

function get_timeline_items(): array {
  return fetch_all(
    'SELECT year, event, description, dot_emoji FROM timeline_items ORDER BY sort_order ASC, id ASC'
  );
}

// KONTAK
function get_contact_info(): array {
  $row = fetch_one(
    'SELECT email_primary, email_secondary, location, hours_weekdays, hours_saturday,
            social_instagram, social_whatsapp, social_youtube, social_tiktok
     FROM contact_info
     ORDER BY id ASC
     LIMIT 1'
  );

  return $row ? $row : [
    'email_primary' => '',
    'email_secondary' => '',
    'location' => '',
    'hours_weekdays' => '',
    'hours_saturday' => '',
    'social_instagram' => '',
    'social_whatsapp' => '',
    'social_youtube' => '',
    'social_tiktok' => '',
  ];
}

function get_faqs(): array {
  return fetch_all(
    'SELECT question, answer FROM faqs ORDER BY sort_order ASC, id ASC'
  );
}
