<?php

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/GaleriModel.php';

class GaleriController extends Controller
{
    private GaleriModel $model;

    public function __construct()
    {
        global $koneksi;
        $this->model = new GaleriModel($koneksi);
    }

    public function index(): void
    {
        $this->view('user/galeri/index', [
            'title' => 'Galeri Kucing - Purrfect Community',
            'catRaces' => $this->model->getAll(),
        ]);
    }
}
