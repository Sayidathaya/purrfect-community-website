<?php

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/core/LoginThrottle.php';
require_once BASE_PATH . '/app/core/SecurityLogger.php';
require_once BASE_PATH . '/app/models/AdminModel.php';

class AuthController extends Controller
{
    private AdminModel $model;
    private LoginThrottle $throttle;

    public function __construct()
    {
        global $koneksi;
        $this->model = new AdminModel($koneksi);
        $this->throttle = new LoginThrottle($koneksi);
    }

    public function login(): void
    {
        if (isset($_SESSION['admin'])) {
            $this->redirect('/admin/dashboard');
        }

        $this->view('auth/login', [
            'title' => 'Login Admin - Purrfect Community',
            'error' => $_SESSION['error'] ?? null,
        ], false);
        unset($_SESSION['error']);
    }

    public function proses(): void
    {
        csrf_require('/admin/login');

        $username = trim((string)($_POST['username'] ?? ''));
        $password = (string)($_POST['password'] ?? '');
        $ip = LoginThrottle::clientIp();
        $blocked = $this->throttle->isBlocked($ip, $username);

        if ($blocked['blocked']) {
            SecurityLogger::log('auth.login_blocked', ['username' => $username, 'retry_after' => $blocked['retry_after']]);
            $_SESSION['error'] = 'Terlalu banyak percobaan. Coba lagi beberapa menit lagi.';
            $this->redirect('/admin/login');
        }

        $admin = $this->model->findByUsername($username);
        if (!$admin || !password_verify($password, (string)$admin['password'])) {
            $failure = $this->throttle->registerFailure($ip, $username);
            SecurityLogger::log('auth.login_failed', ['username' => $username, 'attempts' => $failure['attempts'] ?? 1]);
            $_SESSION['error'] = 'Username atau password salah.';
            $this->redirect('/admin/login');
        }

        $this->throttle->clear($ip, $username);
        session_regenerate_id(true);
        $_SESSION['admin'] = [
            'id' => (int)$admin['id'],
            'username' => (string)$admin['username'],
            'nama' => (string)$admin['nama_lengkap'],
        ];
        SecurityLogger::log('auth.login_success', ['username' => $username], 'info');
        $this->redirect('/admin/dashboard');
    }

    public function logout(): void
    {
        csrf_require('/admin/dashboard');
        SecurityLogger::log('auth.logout', ['username' => $_SESSION['admin']['username'] ?? 'unknown'], 'info');
        unset($_SESSION['admin']);
        session_regenerate_id(true);
        $this->redirect('/admin/login');
    }
}
