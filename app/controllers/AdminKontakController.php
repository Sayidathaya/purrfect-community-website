<?php

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/KontakModel.php';

class AdminKontakController extends Controller
{
    private KontakModel $model;

    public function __construct()
    {
        global $koneksi;
        $this->model = new KontakModel($koneksi);
    }

    public function index(): void
    {
        $this->requireAdmin();
        $messages = $this->model->getMessages();
        $this->model->markAllRead();
        $this->view('admin/kontak/index', [
            'title' => 'Pesan Kontak',
            'messages' => $messages,
        ]);
    }

    public function settings(): void
    {
        $this->requireAdmin();
        $this->view('admin/kontak/settings', [
            'title' => 'Pengaturan Kontak',
            'contact' => $this->model->getContactInfo(),
            'faqs' => $this->model->getFaqs(),
        ]);
    }

    public function updateInfo(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/kontak/settings');
        $this->model->updateContactInfo([
            'email_primary' => $this->post('email_primary'),
            'email_secondary' => $this->post('email_secondary'),
            'location' => $this->post('location'),
            'hours_weekdays' => $this->post('hours_weekdays'),
            'hours_saturday' => $this->post('hours_saturday'),
            'social_instagram' => $this->post('social_instagram'),
            'social_whatsapp' => $this->post('social_whatsapp'),
            'social_youtube' => $this->post('social_youtube'),
            'social_tiktok' => $this->post('social_tiktok'),
        ]);
        $_SESSION['success'] = 'Info kontak berhasil diperbarui.';
        $this->redirect('/admin/kontak/settings');
    }

    public function faqStore(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/kontak/settings');
        $this->model->addFaq($this->post('question'), $this->post('answer'));
        $_SESSION['success'] = 'FAQ berhasil ditambahkan.';
        $this->redirect('/admin/kontak/settings');
    }

    public function faqUpdate(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/kontak/settings');
        $this->model->updateFaq((int)($_POST['id'] ?? 0), $this->post('question'), $this->post('answer'));
        $_SESSION['success'] = 'FAQ berhasil diperbarui.';
        $this->redirect('/admin/kontak/settings');
    }

    public function faqDelete(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/kontak/settings');
        $this->model->deleteFaq((int)($_POST['id'] ?? 0));
        $_SESSION['success'] = 'FAQ berhasil dihapus.';
        $this->redirect('/admin/kontak/settings');
    }

    public function pesanDelete(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/kontak');
        $this->model->deleteMessage((int)($_POST['id'] ?? 0));
        $_SESSION['success'] = 'Pesan berhasil dihapus.';
        $this->redirect('/admin/kontak');
    }

    private function post(string $key): string
    {
        return trim((string)($_POST[$key] ?? ''));
    }
}
