<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';

function json_response(array $data, int $status = 200): void {
  http_response_code($status);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($data, JSON_UNESCAPED_UNICODE);
  exit;
}

function require_method(string $method): void {
  if (($_SERVER['REQUEST_METHOD'] ?? '') !== $method) {
    json_response(['error' => 'Method Not Allowed'], 405);
  }
}
