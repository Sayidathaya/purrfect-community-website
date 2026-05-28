<?php

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/BerandaModel.php';

class BerandaController extends Controller
{
    private BerandaModel $model;

    public function __construct()
    {
        global $koneksi;
        $this->model = new BerandaModel($koneksi);
    }

    public function index(): void
    {
        $hero = $this->model->getHeroBadge();
        $this->view('user/beranda/index', [
            'title' => 'Purrfect Community - Komunitas Pecinta Kucing',
            'heroBadge' => (string)($hero['badge_text'] ?? ''),
            'stats' => $this->model->getStats(),
            'popularArticles' => $this->model->getArticles(),
            'tips' => $this->model->getTips(),
            'cta' => $this->model->getCta(),
        ]);
    }
}
