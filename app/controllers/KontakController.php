<?php

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/KontakModel.php';

class KontakController extends Controller
{
    private KontakModel $model;

    public function __construct()
    {
        global $koneksi;
        $this->model = new KontakModel($koneksi);
    }

    public function index(): void
    {
        $data['title'] = 'Kontak - Purrfect Community';
        $data['contact'] = $this->model->getContactInfo();
        $data['faqs'] = $this->model->getFaqs();
        $data['success'] = $_SESSION['contact_success'] ?? null;
        $data['error'] = $_SESSION['contact_error'] ?? null;
        unset($_SESSION['contact_success'], $_SESSION['contact_error']);

        $this->view('user/kontak/index', $data);
    }

    public function kirim(): void
    {
        csrf_require('/kontak');
        $nama = trim((string)($_POST['nama'] ?? ''));
        $email = trim((string)($_POST['email'] ?? ''));
        $topik = trim((string)($_POST['topik'] ?? ''));
        $pesan = trim((string)($_POST['pesan'] ?? ''));

        if ($nama === '' || $email === '' || $topik === '' || $pesan === '') {
            $_SESSION['contact_error'] = 'Semua field wajib diisi.';
            $this->redirect('/kontak');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['contact_error'] = 'Format email tidak valid.';
            $this->redirect('/kontak');
        }

        $this->model->addMessage($nama, $email, $topik, $pesan);
        $_SESSION['contact_success'] = 'Pesan berhasil dikirim! Kami akan membalas segera. Meong~';
        $this->redirect('/kontak');
    }
}
