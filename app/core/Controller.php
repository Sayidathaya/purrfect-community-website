<?php

require_once BASE_PATH . '/app/core/SecurityLogger.php';

if (!function_exists('h')) {
    function h($value): string
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

class Controller
{
    public function view(string $view, array $data = [], bool $useLayout = true): void
    {
        extract($data);

        $viewFile = BASE_PATH . '/app/views/' . $view . '.php';
        if (!is_file($viewFile)) {
            SecurityLogger::log('view.missing', ['view' => $view], 'error');
            throw new RuntimeException('View tidak ditemukan.');
        }

        if (!$useLayout) {
            require $viewFile;
            return;
        }

        if (strpos($view, 'admin/') === 0) {
            require BASE_PATH . '/app/views/admin/layouts/main.php';
        } else {
            require BASE_PATH . '/app/views/user/layouts/main.php';
        }
    }

    protected function redirect(string $path): void
    {
        header('Location: ' . BASE_URL . $path);
        exit;
    }

    protected function requireAdmin(): void
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }
    }
}
