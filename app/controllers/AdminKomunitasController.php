<?php

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/KomunitasModel.php';

class AdminKomunitasController extends Controller
{
    private KomunitasModel $model;

    public function __construct()
    {
        global $koneksi;
        $this->model = new KomunitasModel($koneksi);
    }

    public function index(): void
    {
        $this->requireAdmin();
        $this->view('admin/komunitas/index', [
            'title' => 'Kelola Komunitas',
            'threads' => $this->model->getThreads(),
            'events' => $this->model->getEvents(),
            'members' => $this->model->getMembers(),
            'tags' => $this->model->getTags(),
        ]);
    }

    public function threadCreate(): void
    {
        $this->requireAdmin();
        $this->view('admin/komunitas/thread_create', ['title' => 'Tambah Diskusi']);
    }

    public function threadStore(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/komunitas/thread/create');
        $this->model->addThread($this->threadData());
        $_SESSION['success'] = 'Diskusi berhasil ditambahkan.';
        $this->redirect('/admin/komunitas');
    }

    public function threadEdit(): void
    {
        $this->requireAdmin();
        $thread = $this->model->getThreadById((int)($_GET['id'] ?? 0));
        if (!$thread) {
            $_SESSION['error'] = 'Diskusi tidak ditemukan.';
            $this->redirect('/admin/komunitas');
        }
        $this->view('admin/komunitas/thread_edit', ['title' => 'Edit Diskusi', 'thread' => $thread]);
    }

    public function threadUpdate(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/komunitas');
        $this->model->updateThread((int)($_POST['id'] ?? 0), $this->threadData());
        $_SESSION['success'] = 'Diskusi berhasil diperbarui.';
        $this->redirect('/admin/komunitas');
    }

    public function threadDelete(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/komunitas');
        $this->model->deleteThread((int)($_POST['id'] ?? 0));
        $_SESSION['success'] = 'Diskusi berhasil dihapus.';
        $this->redirect('/admin/komunitas');
    }

    public function eventCreate(): void
    {
        $this->requireAdmin();
        $this->view('admin/komunitas/event_create', ['title' => 'Tambah Event']);
    }

    public function eventStore(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/komunitas/event/create');
        $this->model->addEvent($this->eventData());
        $_SESSION['success'] = 'Event berhasil ditambahkan.';
        $this->redirect('/admin/komunitas');
    }

    public function eventEdit(): void
    {
        $this->requireAdmin();
        $event = $this->model->getEventById((int)($_GET['id'] ?? 0));
        if (!$event) {
            $_SESSION['error'] = 'Event tidak ditemukan.';
            $this->redirect('/admin/komunitas');
        }
        $this->view('admin/komunitas/event_edit', ['title' => 'Edit Event', 'event' => $event]);
    }

    public function eventUpdate(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/komunitas');
        $this->model->updateEvent((int)($_POST['id'] ?? 0), $this->eventData());
        $_SESSION['success'] = 'Event berhasil diperbarui.';
        $this->redirect('/admin/komunitas');
    }

    public function eventDelete(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/komunitas');
        $this->model->deleteEvent((int)($_POST['id'] ?? 0));
        $_SESSION['success'] = 'Event berhasil dihapus.';
        $this->redirect('/admin/komunitas');
    }

    public function memberStore(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/komunitas');
        $this->model->addMember([
            'name' => $this->post('name'),
            'avatar_emoji' => $this->post('avatar_emoji'),
            'avatar_bg' => $this->post('avatar_bg') ?: '#FFF1E6',
            'posts_count' => (int)($_POST['posts_count'] ?? 0),
        ]);
        $_SESSION['success'] = 'Member berhasil ditambahkan.';
        $this->redirect('/admin/komunitas');
    }

    public function memberDelete(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/komunitas');
        $this->model->deleteMember((int)($_POST['id'] ?? 0));
        $_SESSION['success'] = 'Member berhasil dihapus.';
        $this->redirect('/admin/komunitas');
    }

    public function tagStore(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/komunitas');
        $tag = $this->post('tag');
        if ($tag !== '') {
            $this->model->addTag($tag);
        }
        $_SESSION['success'] = 'Tag berhasil ditambahkan.';
        $this->redirect('/admin/komunitas');
    }

    public function tagDelete(): void
    {
        $this->requireAdmin();
        csrf_require('/admin/komunitas');
        $this->model->deleteTag((int)($_POST['id'] ?? 0));
        $_SESSION['success'] = 'Tag berhasil dihapus.';
        $this->redirect('/admin/komunitas');
    }

    private function threadData(): array
    {
        return [
            'category' => $this->post('category'),
            'title' => $this->post('title'),
            'author' => $this->post('author'),
            'author_avatar_emoji' => $this->post('author_avatar_emoji') ?: 'Cat',
            'author_avatar_bg' => $this->post('author_avatar_bg') ?: '#FFF1E6',
            'published_text' => $this->post('published_text') ?: 'baru saja',
            'preview' => $this->post('preview'),
            'replies_count' => (int)($_POST['replies_count'] ?? 0),
            'views_count' => (int)($_POST['views_count'] ?? 0),
            'likes_count' => (int)($_POST['likes_count'] ?? 0),
        ];
    }

    private function eventData(): array
    {
        return [
            'event_date' => $this->post('event_date'),
            'title' => $this->post('title'),
            'description' => $this->post('description'),
            'tag' => $this->post('tag'),
        ];
    }

    private function post(string $key): string
    {
        return trim((string)($_POST[$key] ?? ''));
    }
}
