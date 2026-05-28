<?php

require_once BASE_PATH . '/app/core/SecurityLogger.php';

class Router
{
    private array $routes = [];

    public function get(string $path, string $action): void
    {
        $this->routes['GET'][$path] = $action;
    }

    public function post(string $path, string $action): void
    {
        $this->routes['POST'][$path] = $action;
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $url = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

        if (defined('BASE_URL') && BASE_URL !== '') {
            if (strpos($url, BASE_URL) === 0) {
                $url = substr($url, strlen(BASE_URL));
            }
        }

        if (strpos($url, '/public') === 0) {
            $url = substr($url, 7) ?: '/';
        }

        $url = trim($url, '/');
        $url = $url === '' ? '/' : '/' . $url;

        $action = $this->routes[$method][$url] ?? null;

        if (!$action) {
            http_response_code(404);
            require BASE_PATH . '/app/views/user/errors/404.php';
            return;
        }

        [$controllerName, $methodAction] = explode('@', $action);
        $file = BASE_PATH . "/app/controllers/$controllerName.php";

        if (!is_file($file)) {
            SecurityLogger::log('router.controller_missing', ['controller' => $controllerName], 'error');
            throw new RuntimeException('Terjadi kesalahan pada server.');
        }

        require_once $file;

        if (!class_exists($controllerName)) {
            SecurityLogger::log('router.class_missing', ['controller' => $controllerName], 'error');
            throw new RuntimeException('Terjadi kesalahan pada server.');
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $methodAction)) {
            SecurityLogger::log('router.method_missing', [
                'controller' => $controllerName,
                'method' => $methodAction,
            ], 'error');
            throw new RuntimeException('Terjadi kesalahan pada server.');
        }

        $controller->$methodAction();
    }
}
