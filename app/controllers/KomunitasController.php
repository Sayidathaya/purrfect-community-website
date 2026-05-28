<?php

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/KomunitasModel.php';

class KomunitasController extends Controller
{
    private KomunitasModel $model;

    public function __construct()
    {
        global $koneksi;
        $this->model = new KomunitasModel($koneksi);
    }

    public function index(): void
    {
        $this->view('user/komunitas/index', [
            'title' => 'Komunitas - Purrfect Community',
            'threads' => $this->model->getThreads(),
            'events' => $this->model->getEvents(),
            'members' => $this->model->getMembers(),
            'topicTags' => $this->model->getTags(),
        ]);
    }
}
