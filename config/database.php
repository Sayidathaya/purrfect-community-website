<?php

if (!function_exists('cfg_env')) {
    function cfg_env(string $key, string $default = ''): string
    {
        $value = getenv($key);
        return $value === false ? $default : trim((string)$value);
    }
}

if (!function_exists('cfg_env_bool')) {
    function cfg_env_bool(string $key, bool $default = false): bool
    {
        $value = getenv($key);
        if ($value === false) {
            return $default;
        }

        return in_array(strtolower(trim((string)$value)), ['1', 'true', 'yes', 'on'], true);
    }
}

define('DB_HOST', cfg_env('DB_HOST', 'localhost'));
define('DB_USER', cfg_env('DB_USER', 'root'));
define('DB_PASS', cfg_env('DB_PASS', ''));
define('DB_NAME', cfg_env('DB_NAME', 'purrfect'));
define('DB_CHARSET', cfg_env('DB_CHARSET', 'utf8mb4'));

$autoInit = cfg_env_bool('DB_AUTO_INIT', true);
$autoSeed = cfg_env_bool('DB_AUTO_SEED', true);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$koneksi = null;
try {
    $koneksi = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
} catch (mysqli_sql_exception $e) {
    if ($autoInit && (int)$e->getCode() === 1049) {
        $koneksi = new mysqli(DB_HOST, DB_USER, DB_PASS);
        $koneksi->query(
            "CREATE DATABASE IF NOT EXISTS `" . $koneksi->real_escape_string(DB_NAME) . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
        );
        $koneksi->select_db(DB_NAME);
    } else {
        throw $e;
    }
}

$koneksi->set_charset(DB_CHARSET);

if ($autoInit) {
    purrfect_create_security_tables($koneksi);
    purrfect_run_sql_file($koneksi, BASE_PATH . '/purrfect.sql', $autoSeed);
    purrfect_create_security_tables($koneksi);
    purrfect_ensure_column($koneksi, 'cat_races', 'created_at', "TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
    purrfect_ensure_column($koneksi, 'contact_messages', 'is_read', "TINYINT(1) NOT NULL DEFAULT 0");
    $koneksi->query(
        "DELETE FROM auth_login_attempts
         WHERE last_attempt_at < DATE_SUB(NOW(), INTERVAL 2 DAY)"
    );
}

if ($autoSeed) {
    purrfect_seed_admin($koneksi);
}

function purrfect_create_security_tables(mysqli $db): void
{
    $db->query(
        "CREATE TABLE IF NOT EXISTS admin (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(100) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            nama_lengkap VARCHAR(150) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
    );

    $db->query(
        "CREATE TABLE IF NOT EXISTS auth_login_attempts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            ip_address VARCHAR(45) NOT NULL,
            username VARCHAR(100) NOT NULL,
            attempts INT NOT NULL DEFAULT 0,
            first_attempt_at DATETIME NOT NULL,
            last_attempt_at DATETIME NOT NULL,
            blocked_until DATETIME NULL,
            UNIQUE KEY uniq_auth_attempt (ip_address, username),
            INDEX idx_blocked_until (blocked_until)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
    );
}

function purrfect_run_sql_file(mysqli $db, string $file, bool $seed): void
{
    if (!is_file($file)) {
        return;
    }

    $sql = (string)file_get_contents($file);
    $statements = purrfect_split_sql($sql);

    foreach ($statements as $statement) {
        $trimmed = trim($statement);
        if ($trimmed === '') {
            continue;
        }

        if (preg_match('/^\s*(CREATE\s+DATABASE|USE)\s+/i', $trimmed)) {
            continue;
        }

        if (!$seed && preg_match('/^\s*INSERT\s+/i', $trimmed)) {
            continue;
        }

        if (preg_match('/^\s*INSERT\s+INTO\s+/i', $trimmed)) {
            $trimmed = preg_replace('/^\s*INSERT\s+INTO\s+/i', 'INSERT IGNORE INTO ', $trimmed) ?? $trimmed;
        }

        $db->query($trimmed);
    }
}

function purrfect_split_sql(string $sql): array
{
    $statements = [];
    $buffer = '';
    $inString = false;
    $quote = '';
    $length = strlen($sql);

    for ($i = 0; $i < $length; $i++) {
        $char = $sql[$i];
        $next = $sql[$i + 1] ?? '';

        if (!$inString && $char === '-' && $next === '-') {
            while ($i < $length && $sql[$i] !== "\n") {
                $i++;
            }
            continue;
        }

        if (($char === "'" || $char === '"') && ($i === 0 || $sql[$i - 1] !== '\\')) {
            if (!$inString) {
                $inString = true;
                $quote = $char;
            } elseif ($quote === $char) {
                $inString = false;
                $quote = '';
            }
        }

        if ($char === ';' && !$inString) {
            $statements[] = $buffer;
            $buffer = '';
            continue;
        }

        $buffer .= $char;
    }

    if (trim($buffer) !== '') {
        $statements[] = $buffer;
    }

    return $statements;
}

function purrfect_seed_admin(mysqli $db): void
{
    $result = $db->query("SELECT COUNT(*) AS total FROM admin");
    $row = $result->fetch_assoc();
    if ((int)($row['total'] ?? 0) > 0) {
        return;
    }

    $username = 'admin';
    $password = password_hash('admin123', PASSWORD_DEFAULT);
    $nama = 'Administrator';

    $stmt = $db->prepare(
        "INSERT INTO admin (username, password, nama_lengkap) VALUES (?, ?, ?)"
    );
    $stmt->bind_param('sss', $username, $password, $nama);
    $stmt->execute();
    $stmt->close();
}

function purrfect_ensure_column(mysqli $db, string $table, string $column, string $definition): void
{
    $tableEsc = $db->real_escape_string($table);
    $columnEsc = $db->real_escape_string($column);
    $result = $db->query("SHOW COLUMNS FROM `{$tableEsc}` LIKE '{$columnEsc}'");
    if ($result && $result->num_rows > 0) {
        return;
    }

    $db->query("ALTER TABLE `{$tableEsc}` ADD COLUMN `{$columnEsc}` {$definition}");
}
