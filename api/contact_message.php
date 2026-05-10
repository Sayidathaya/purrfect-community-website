<?php
declare(strict_types=1);

require_once __DIR__ . '/../server/http_helpers.php';

require_once __DIR__ . '/../server/db.php';

require_method('POST');

$raw = file_get_contents('php://input');
$data = json_decode((string)$raw, true);

if (!is_array($data)) {
  json_response(['error' => 'Invalid JSON body'], 400);
}

$name = trim((string)($data['name'] ?? ''));
$email = trim((string)($data['email'] ?? ''));
$topic = trim((string)($data['topic'] ?? ''));
$message = trim((string)($data['message'] ?? ''));

if ($name === '' || $email === '' || $topic === '' || $message === '') {
  json_response(['error' => 'Harap isi semua field yang diperlukan!'], 422);
}

if (!preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
  json_response(['error' => 'Format email tidak valid!'], 422);
}

$stmt = $pdo->prepare(
  'INSERT INTO contact_messages (name, email, topic, message) VALUES (:name, :email, :topic, :message)'
);

$stmt->execute([
  ':name' => $name,
  ':email' => $email,
  ':topic' => $topic,
  ':message' => $message,
]);

json_response(['success' => true, 'message' => 'Pesan tersimpan'], 201);
