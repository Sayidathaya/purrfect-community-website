<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';

$schemaPath = __DIR__ . '/schema.sql';
if (!is_file($schemaPath)) {
  fwrite(STDERR, "schema.sql not found at {$schemaPath}\n");
  exit(1);
}

$sql = file_get_contents($schemaPath);
if ($sql === false || trim($sql) === '') {
  fwrite(STDERR, "schema.sql is empty\n");
  exit(1);
}

/**
 * MySQL PDO doesn't support multi-statement by prepare/execute reliably unless
 * we split statements; here we do a simple statement splitter.
 *
 * Note: This assumes schema.sql does not contain semicolons inside strings.
 */
$statements = preg_split('/;\s*(?:\r?\n|$)/', $sql);
if (!is_array($statements)) {
  fwrite(STDERR, "Failed to split statements\n");
  exit(1);
}

$executed = 0;
foreach ($statements as $stmt) {
  $stmt = trim($stmt);
  if ($stmt === '') continue;
  if (str_starts_with($stmt, '--') || str_starts_with($stmt, '/*')) continue;

  try {
    $pdo->exec($stmt);
    $executed++;
  } catch (Throwable $e) {
    $message = $e->getMessage();

    // Make setup idempotent: ignore duplicate key errors from seed data.
    // MySQL duplicate entry is error code 1062.
    if (str_contains($message, ' 1062 ') || str_contains($message, '1062')) {
      fwrite(STDOUT, "Seed skipped (duplicate key): {$message}\n");
      continue;
    }

    fwrite(STDERR, "Failed executing statement:\n{$stmt}\n\nError: {$message}\n");
    exit(1);
  }
}

fwrite(STDOUT, "OK. Executed statements: {$executed}\n");
