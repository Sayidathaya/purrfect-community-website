<?php

require_once BASE_PATH . '/app/core/Model.php';

class AdminModel extends Model
{
    public function findByUsername(string $username): ?array
    {
        return $this->fetchOne(
            "SELECT id, username, password, nama_lengkap FROM admin WHERE username = ? LIMIT 1",
            's',
            [$username]
        );
    }

    public function dashboardCounts(): array
    {
        return [
            'cat_races' => $this->scalarCount("SELECT COUNT(*) AS total FROM cat_races"),
            'threads' => $this->scalarCount("SELECT COUNT(*) AS total FROM forum_threads"),
            'events' => $this->scalarCount("SELECT COUNT(*) AS total FROM events"),
            'unread_messages' => $this->scalarCount("SELECT COUNT(*) AS total FROM contact_messages WHERE is_read = 0"),
        ];
    }

    public function monthlyUploadCounts(): array
    {
        return $this->fetchAll(
            "SELECT DATE_FORMAT(created_at, '%Y-%m') AS month_label, COUNT(*) AS total
             FROM cat_races
             WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 11 MONTH)
             GROUP BY DATE_FORMAT(created_at, '%Y-%m')
             ORDER BY month_label ASC"
        );
    }

    public function latestMessages(int $limit = 5): array
    {
        return $this->fetchAll(
            "SELECT id, name, email, topic, message, created_at, is_read
             FROM contact_messages
             ORDER BY created_at DESC, id DESC
             LIMIT ?",
            'i',
            [$limit]
        );
    }
}
