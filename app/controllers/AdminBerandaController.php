<?php

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/BerandaModel.php';

class AdminBerandaController extends Controller
{
    private BerandaModel $model;

    public function __construct()
    {
        global $koneksi;
        $this->model = new BerandaModel($koneksi);
    }

    public function index(): void
    {
        $this->requireAdmin();
        $this->view('admin/beranda/index', [
            'title' => 'Kelola Beranda',
            'hero' => $this->model->getHeroBadge(),
            'stats' => $this->model->getStats(),
            'articles' => $this->model->getArticles(),
            'tips' => $this->model->getTips(),
            'cta' => $this->model->getCta(),
        ]);
    }

    public function updateHero(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/beranda');
        $this->model->updateHeroBadge(trim((string)($_POST['badge_text'] ?? '')));
        $_SESSION['success'] = 'Hero beranda berhasil diperbarui.';
        $this->redirect('/admin/beranda');
    }

    public function updateStats(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/beranda');
        $ids = $_POST['id'] ?? [];
        $numbers = $_POST['number_text'] ?? [];
        $labels = $_POST['label_text'] ?? [];
        if (is_array($ids)) {
            foreach ($ids as $index => $id) {
                $this->model->updateStat((int)$id, trim((string)($numbers[$index] ?? '')), trim((string)($labels[$index] ?? '')));
            }
        }
        $_SESSION['success'] = 'Statistik berhasil diperbarui.';
        $this->redirect('/admin/beranda');
    }

    public function storeArtikel(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/beranda');
        $this->model->addArticle($this->post('tag'), $this->post('title'), $this->post('description'));
        $_SESSION['success'] = 'Artikel berhasil ditambahkan.';
        $this->redirect('/admin/beranda');
    }

    public function updateArtikel(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/beranda');
        $this->model->updateArticle((int)($_POST['id'] ?? 0), $this->post('tag'), $this->post('title'), $this->post('description'));
        $_SESSION['success'] = 'Artikel berhasil diperbarui.';
        $this->redirect('/admin/beranda');
    }

    public function deleteArtikel(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/beranda');
        $this->model->deleteArticle((int)($_POST['id'] ?? 0));
        $_SESSION['success'] = 'Artikel berhasil dihapus.';
        $this->redirect('/admin/beranda');
    }

    public function storeTip(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/beranda');
        $this->model->addTip($this->post('icon'), $this->post('title'), $this->post('description'));
        $_SESSION['success'] = 'Tips berhasil ditambahkan.';
        $this->redirect('/admin/beranda');
    }

    public function updateTip(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/beranda');
        $this->model->updateTip((int)($_POST['id'] ?? 0), $this->post('icon'), $this->post('title'), $this->post('description'));
        $_SESSION['success'] = 'Tips berhasil diperbarui.';
        $this->redirect('/admin/beranda');
    }

    public function deleteTip(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/beranda');
        $this->model->deleteTip((int)($_POST['id'] ?? 0));
        $_SESSION['success'] = 'Tips berhasil dihapus.';
        $this->redirect('/admin/beranda');
    }

    public function updateCta(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/beranda');
        $this->model->updateCta($this->post('heading'), $this->post('description'), $this->post('button_text'), $this->post('button_href'));
        $_SESSION['success'] = 'CTA berhasil diperbarui.';
        $this->redirect('/admin/beranda');
    }

    private function post(string $key): string
    {
        return trim((string)($_POST[$key] ?? ''));
    }
}
