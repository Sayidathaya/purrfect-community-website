<?php

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/TentangModel.php';

class TentangController extends Controller
{
    private TentangModel $model;

    public function __construct()
    {
        global $koneksi;
        $this->model = new TentangModel($koneksi);
    }

    public function index(): void
    {
        $this->view('user/tentang/index', [
            'title' => 'Tentang Kami - Purrfect Community',
            'aboutHero' => $this->model->getHero(),
            'values' => $this->model->getValues(),
            'team' => $this->model->getTeam(),
            'timeline' => $this->model->getTimeline(),
        ]);
    }
}
