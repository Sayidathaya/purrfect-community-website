<?php
declare(strict_types=1);

// This endpoint is intentionally local-only (no SQL). It exists to satisfy "real time save" semantics
// but persistence is handled by the browser using localStorage for the current user/session.
require_once __DIR__ . '/../server/http_helpers.php';

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
  json_response(['error' => 'Method Not Allowed'], 405);
}

$raw = file_get_contents('php://input');
$data = json_decode((string)$raw, true);
if (!is_array($data)) {
  json_response(['error' => 'Invalid JSON body'], 400);
}

json_response(['ok' => true, 'received' => $data], 200);
