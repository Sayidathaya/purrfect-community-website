<?php

require_once BASE_PATH . '/app/core/Model.php';

class TentangModel extends Model
{
    public function getHero(): ?array
    {
        return $this->fetchOne("SELECT id, tag, heading, description FROM about_hero ORDER BY id ASC LIMIT 1");
    }

    public function updateHero(string $tag, string $heading, string $desc): bool
    {
        return $this->execute(
            "INSERT INTO about_hero (id, tag, heading, description) VALUES (1, ?, ?, ?)
             ON DUPLICATE KEY UPDATE tag = ?, heading = ?, description = ?",
            'ssssss',
            [$tag, $heading, $desc, $tag, $heading, $desc]
        );
    }

    public function getValues(): array
    {
        return $this->fetchAll("SELECT id, icon, title, description FROM `values` ORDER BY sort_order ASC, id ASC");
    }

    public function addValue(string $icon, string $title, string $desc): bool
    {
        $sort = $this->nextSort('values');
        return $this->execute(
            "INSERT INTO `values` (icon, title, description, sort_order) VALUES (?, ?, ?, ?)",
            'sssi',
            [$icon, $title, $desc, $sort]
        );
    }

    public function updateValue(int $id, string $icon, string $title, string $desc): bool
    {
        return $this->execute(
            "UPDATE `values` SET icon = ?, title = ?, description = ? WHERE id = ?",
            'sssi',
            [$icon, $title, $desc, $id]
        );
    }

    public function deleteValue(int $id): bool
    {
        return $this->execute("DELETE FROM `values` WHERE id = ?", 'i', [$id]);
    }

    public function getTeam(): array
    {
        return $this->fetchAll("SELECT id, name, role, bio, avatar_emoji, avatar_bg, cats_text FROM team_members ORDER BY sort_order ASC, id ASC");
    }

    public function addTeamMember(array $data): bool
    {
        $sort = $this->nextSort('team_members');
        return $this->execute(
            "INSERT INTO team_members (name, role, bio, avatar_emoji, avatar_bg, cats_text, sort_order)
             VALUES (?, ?, ?, ?, ?, ?, ?)",
            'ssssssi',
            [
                (string)$data['name'],
                (string)$data['role'],
                (string)$data['bio'],
                (string)$data['avatar_emoji'],
                (string)$data['avatar_bg'],
                (string)$data['cats_text'],
                $sort,
            ]
        );
    }

    public function updateTeamMember(int $id, array $data): bool
    {
        return $this->execute(
            "UPDATE team_members
             SET name = ?, role = ?, bio = ?, avatar_emoji = ?, avatar_bg = ?, cats_text = ?
             WHERE id = ?",
            'ssssssi',
            [
                (string)$data['name'],
                (string)$data['role'],
                (string)$data['bio'],
                (string)$data['avatar_emoji'],
                (string)$data['avatar_bg'],
                (string)$data['cats_text'],
                $id,
            ]
        );
    }

    public function deleteTeamMember(int $id): bool
    {
        return $this->execute("DELETE FROM team_members WHERE id = ?", 'i', [$id]);
    }

    public function getTimeline(): array
    {
        return $this->fetchAll("SELECT id, year, event, description, dot_emoji FROM timeline_items ORDER BY sort_order ASC, id ASC");
    }

    public function addTimeline(array $data): bool
    {
        $sort = $this->nextSort('timeline_items');
        return $this->execute(
            "INSERT INTO timeline_items (year, event, description, dot_emoji, sort_order) VALUES (?, ?, ?, ?, ?)",
            'ssssi',
            [(string)$data['year'], (string)$data['event'], (string)$data['description'], (string)$data['dot_emoji'], $sort]
        );
    }

    public function updateTimeline(int $id, array $data): bool
    {
        return $this->execute(
            "UPDATE timeline_items SET year = ?, event = ?, description = ?, dot_emoji = ? WHERE id = ?",
            'ssssi',
            [(string)$data['year'], (string)$data['event'], (string)$data['description'], (string)$data['dot_emoji'], $id]
        );
    }

    public function deleteTimeline(int $id): bool
    {
        return $this->execute("DELETE FROM timeline_items WHERE id = ?", 'i', [$id]);
    }

    private function nextSort(string $table): int
    {
        $allowed = ['values', 'team_members', 'timeline_items'];
        if (!in_array($table, $allowed, true)) {
            throw new InvalidArgumentException('Invalid sort table.');
        }

        $quoted = $table === 'values' ? '`values`' : $table;
        $row = $this->db->query("SELECT COALESCE(MAX(sort_order), 0) + 1 AS next_order FROM {$quoted}")->fetch_assoc();
        return (int)($row['next_order'] ?? 1);
    }
}
