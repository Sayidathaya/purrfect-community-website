<?php

require_once BASE_PATH . '/app/core/Model.php';

class BerandaModel extends Model
{
    public function getHeroBadge(): ?array
    {
        return $this->fetchOne("SELECT id, badge_text FROM hero_badge ORDER BY id ASC LIMIT 1");
    }

    public function updateHeroBadge(string $text): bool
    {
        return $this->execute(
            "INSERT INTO hero_badge (id, badge_text) VALUES (1, ?)
             ON DUPLICATE KEY UPDATE badge_text = ?",
            'ss',
            [$text, $text]
        );
    }

    public function getStats(): array
    {
        return $this->fetchAll("SELECT id, number_text, label_text FROM stats ORDER BY sort_order ASC, id ASC");
    }

    public function updateStat(int $id, string $number, string $label): bool
    {
        return $this->execute(
            "UPDATE stats SET number_text = ?, label_text = ? WHERE id = ?",
            'ssi',
            [$number, $label, $id]
        );
    }

    public function getArticles(): array
    {
        return $this->fetchAll("SELECT id, tag, title, description FROM popular_articles ORDER BY sort_order ASC, id ASC");
    }

    public function addArticle(string $tag, string $title, string $desc): bool
    {
        $sort = $this->nextSort('popular_articles');
        return $this->execute(
            "INSERT INTO popular_articles (tag, title, description, sort_order) VALUES (?, ?, ?, ?)",
            'sssi',
            [$tag, $title, $desc, $sort]
        );
    }

    public function updateArticle(int $id, string $tag, string $title, string $desc): bool
    {
        return $this->execute(
            "UPDATE popular_articles SET tag = ?, title = ?, description = ? WHERE id = ?",
            'sssi',
            [$tag, $title, $desc, $id]
        );
    }

    public function deleteArticle(int $id): bool
    {
        return $this->execute("DELETE FROM popular_articles WHERE id = ?", 'i', [$id]);
    }

    public function getTips(): array
    {
        return $this->fetchAll("SELECT id, icon, title, description FROM tips ORDER BY sort_order ASC, id ASC");
    }

    public function addTip(string $icon, string $title, string $desc): bool
    {
        $sort = $this->nextSort('tips');
        return $this->execute(
            "INSERT INTO tips (icon, title, description, sort_order) VALUES (?, ?, ?, ?)",
            'sssi',
            [$icon, $title, $desc, $sort]
        );
    }

    public function updateTip(int $id, string $icon, string $title, string $desc): bool
    {
        return $this->execute(
            "UPDATE tips SET icon = ?, title = ?, description = ? WHERE id = ?",
            'sssi',
            [$icon, $title, $desc, $id]
        );
    }

    public function deleteTip(int $id): bool
    {
        return $this->execute("DELETE FROM tips WHERE id = ?", 'i', [$id]);
    }

    public function getCta(): ?array
    {
        return $this->fetchOne("SELECT id, heading, description, button_text, button_href FROM cta_banner ORDER BY id ASC LIMIT 1");
    }

    public function updateCta(string $heading, string $desc, string $btn, string $href): bool
    {
        return $this->execute(
            "INSERT INTO cta_banner (id, heading, description, button_text, button_href)
             VALUES (1, ?, ?, ?, ?)
             ON DUPLICATE KEY UPDATE heading = ?, description = ?, button_text = ?, button_href = ?",
            'ssssssss',
            [$heading, $desc, $btn, $href, $heading, $desc, $btn, $href]
        );
    }

    private function nextSort(string $table): int
    {
        $allowed = ['popular_articles', 'tips'];
        if (!in_array($table, $allowed, true)) {
            throw new InvalidArgumentException('Invalid sort table.');
        }

        $row = $this->db->query("SELECT COALESCE(MAX(sort_order), 0) + 1 AS next_order FROM {$table}")->fetch_assoc();
        return (int)($row['next_order'] ?? 1);
    }
}
