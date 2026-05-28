<?php

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/TentangModel.php';

class AdminTentangController extends Controller
{
    private TentangModel $model;

    public function __construct()
    {
        global $koneksi;
        $this->model = new TentangModel($koneksi);
    }

    public function index(): void
    {
        $this->requireAdmin();
        $this->view('admin/tentang/index', [
            'title' => 'Kelola Tentang',
            'hero' => $this->model->getHero(),
            'values' => $this->model->getValues(),
            'team' => $this->model->getTeam(),
            'timeline' => $this->model->getTimeline(),
        ]);
    }

    public function updateHero(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/tentang');
        $this->model->updateHero($this->post('tag'), $this->post('heading'), $this->post('description'));
        $_SESSION['success'] = 'Hero tentang berhasil diperbarui.';
        $this->redirect('/admin/tentang');
    }

    public function valueStore(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/tentang');
        $this->model->addValue($this->post('icon'), $this->post('title'), $this->post('description'));
        $_SESSION['success'] = 'Nilai berhasil ditambahkan.';
        $this->redirect('/admin/tentang');
    }

    public function valueUpdate(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/tentang');
        $this->model->updateValue((int)($_POST['id'] ?? 0), $this->post('icon'), $this->post('title'), $this->post('description'));
        $_SESSION['success'] = 'Nilai berhasil diperbarui.';
        $this->redirect('/admin/tentang');
    }

    public function valueDelete(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/tentang');
        $this->model->deleteValue((int)($_POST['id'] ?? 0));
        $_SESSION['success'] = 'Nilai berhasil dihapus.';
        $this->redirect('/admin/tentang');
    }

    public function teamStore(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/tentang');
        $this->model->addTeamMember($this->teamData());
        $_SESSION['success'] = 'Anggota tim berhasil ditambahkan.';
        $this->redirect('/admin/tentang');
    }

    public function teamUpdate(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/tentang');
        $this->model->updateTeamMember((int)($_POST['id'] ?? 0), $this->teamData());
        $_SESSION['success'] = 'Anggota tim berhasil diperbarui.';
        $this->redirect('/admin/tentang');
    }

    public function teamDelete(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/tentang');
        $this->model->deleteTeamMember((int)($_POST['id'] ?? 0));
        $_SESSION['success'] = 'Anggota tim berhasil dihapus.';
        $this->redirect('/admin/tentang');
    }

    public function timelineStore(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/tentang');
        $this->model->addTimeline($this->timelineData());
        $_SESSION['success'] = 'Timeline berhasil ditambahkan.';
        $this->redirect('/admin/tentang');
    }

    public function timelineUpdate(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/tentang');
        $this->model->updateTimeline((int)($_POST['id'] ?? 0), $this->timelineData());
        $_SESSION['success'] = 'Timeline berhasil diperbarui.';
        $this->redirect('/admin/tentang');
    }

    public function timelineDelete(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/tentang');
        $this->model->deleteTimeline((int)($_POST['id'] ?? 0));
        $_SESSION['success'] = 'Timeline berhasil dihapus.';
        $this->redirect('/admin/tentang');
    }

    private function teamData(): array
    {
        return [
            'name' => $this->post('name'),
            'role' => $this->post('role'),
            'bio' => $this->post('bio'),
            'avatar_emoji' => $this->post('avatar_emoji'),
            'avatar_bg' => $this->post('avatar_bg') ?: '#FFF1E6',
            'cats_text' => $this->post('cats_text'),
        ];
    }

    private function timelineData(): array
    {
        return [
            'year' => $this->post('year'),
            'event' => $this->post('event'),
            'description' => $this->post('description'),
            'dot_emoji' => $this->post('dot_emoji'),
        ];
    }

    private function post(string $key): string
    {
        return trim((string)($_POST[$key] ?? ''));
    }
}
