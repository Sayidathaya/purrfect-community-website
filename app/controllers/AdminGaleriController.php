<?php

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/GaleriModel.php';

class AdminGaleriController extends Controller
{
    private GaleriModel $model;

    public function __construct()
    {
        global $koneksi;
        $this->model = new GaleriModel($koneksi);
    }

    public function index(): void
    {
        $this->requireAdmin();
        $this->view('admin/galeri/index', [
            'title' => 'Kelola Galeri',
            'races' => $this->model->getAll(),
        ]);
    }

    public function create(): void
    {
        $this->requireAdmin();
        $this->view('admin/galeri/create', ['title' => 'Tambah Ras Kucing']);
    }

    public function store(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/galeri/create');
        $data = $this->raceData();
        if ($data['name'] === '') {
            $_SESSION['error'] = 'Nama ras wajib diisi.';
            $this->redirect('/admin/galeri/create');
        }
        $this->model->add($data);
        $this->model->replaceTraits($this->model->lastInsertId(), $this->traits());
        $_SESSION['success'] = 'Ras kucing berhasil ditambahkan.';
        $this->redirect('/admin/galeri');
    }

    public function edit(): void
    {
        $this->requireAdmin();
        $id = (int)($_GET['id'] ?? 0);
        $race = $this->model->getById($id);
        if (!$race) {
            $_SESSION['error'] = 'Data ras tidak ditemukan.';
            $this->redirect('/admin/galeri');
        }
        $race['traits'] = $this->model->getTraitsByRaceId($id);
        $this->view('admin/galeri/edit', ['title' => 'Edit Ras Kucing', 'race' => $race]);
    }

    public function update(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/galeri');
        $id = (int)($_POST['id'] ?? 0);
        $this->model->update($id, $this->raceData());
        $this->model->replaceTraits($id, $this->traits());
        $_SESSION['success'] = 'Ras kucing berhasil diperbarui.';
        $this->redirect('/admin/galeri');
    }

    public function delete(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/galeri');
        $this->model->delete((int)($_POST['id'] ?? 0));
        $_SESSION['success'] = 'Ras kucing berhasil dihapus.';
        $this->redirect('/admin/galeri');
    }

    private function raceData(): array
    {
        return [
            'name' => trim((string)($_POST['name'] ?? '')),
            'origin' => trim((string)($_POST['origin'] ?? '')),
            'description' => trim((string)($_POST['description'] ?? '')),
            'category' => in_array(($_POST['category'] ?? ''), ['Lokal', 'Impor'], true) ? (string)$_POST['category'] : 'Lokal',
            'emoji' => trim((string)($_POST['emoji'] ?? '')),
            'color_bg' => trim((string)($_POST['color_bg'] ?? '#FFF1E6')),
        ];
    }

    private function traits(): array
    {
        return array_filter(array_map('trim', explode(',', (string)($_POST['traits'] ?? ''))));
    }
}
