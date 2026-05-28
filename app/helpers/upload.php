<?php

require_once BASE_PATH . '/app/core/SecurityLogger.php';

function handle_image_upload(string $field, string $subdir, ?string $existing = null): ?string
{
    if (empty($_FILES[$field]) || !is_array($_FILES[$field])) {
        return $existing;
    }

    $file = $_FILES[$field];
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return $existing;
    }

    if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
        SecurityLogger::log('upload.error', ['field' => $field, 'code' => $file['error'] ?? null]);
        throw new RuntimeException('Upload gambar gagal.');
    }

    $originalName = (string)($file['name'] ?? '');
    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
    if (!in_array($ext, $allowedExt, true)) {
        SecurityLogger::log('upload.invalid_type', ['file' => $originalName]);
        throw new RuntimeException('Format gambar harus jpg, jpeg, png, atau webp.');
    }

    $tmpName = (string)($file['tmp_name'] ?? '');
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($tmpName);
    $allowedMime = ['image/jpeg', 'image/png', 'image/webp'];
    if (!in_array((string)$mime, $allowedMime, true)) {
        SecurityLogger::log('upload.invalid_mime', ['file' => $originalName, 'mime' => $mime]);
        throw new RuntimeException('MIME gambar tidak valid.');
    }

    $safeSubdir = trim(str_replace(['..', '\\'], ['', '/'], $subdir), '/');
    $uploadDir = BASE_PATH . '/public/assets/uploads/' . $safeSubdir;
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $filename = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
    $destination = $uploadDir . '/' . $filename;

    if (!move_uploaded_file($tmpName, $destination)) {
        SecurityLogger::log('upload.move_failed', ['file' => $originalName]);
        throw new RuntimeException('Gagal menyimpan gambar.');
    }

    return 'assets/uploads/' . $safeSubdir . '/' . $filename;
}
