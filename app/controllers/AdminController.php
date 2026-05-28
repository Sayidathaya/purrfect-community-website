<?php

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/AdminModel.php';

class AdminController extends Controller
{
    private AdminModel $model;

    public function __construct()
    {
        global $koneksi;
        $this->model = new AdminModel($koneksi);
    }

    public function dashboard(): void
    {
        $this->requireAdmin();
        $this->view('admin/dashboard', [
            'title' => 'Dashboard Admin',
            'counts' => $this->model->dashboardCounts(),
            'chartRows' => $this->model->monthlyUploadCounts(),
            'latestMessages' => $this->model->latestMessages(5),
        ]);
    }
}
