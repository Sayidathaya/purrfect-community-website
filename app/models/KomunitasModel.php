<?php

require_once BASE_PATH . '/app/core/Model.php';

class KomunitasModel extends Model
{
    public function getThreads(): array
    {
        return $this->fetchAll(
            "SELECT id, category, title, author, author_avatar_emoji, author_avatar_bg, published_text,
                    preview, replies_count, views_count, likes_count
             FROM forum_threads
             ORDER BY sort_order ASC, id ASC"
        );
    }

    public function getThreadById(int $id): ?array
    {
        return $this->fetchOne("SELECT * FROM forum_threads WHERE id = ? LIMIT 1", 'i', [$id]);
    }

    public function addThread(array $data): bool
    {
        $sort = $this->nextSort('forum_threads');
        return $this->execute(
            "INSERT INTO forum_threads
             (category, title, author, author_avatar_emoji, author_avatar_bg, published_text, preview,
              replies_count, views_count, likes_count, sort_order)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            'sssssssiiii',
            [
                (string)$data['category'],
                (string)$data['title'],
                (string)$data['author'],
                (string)$data['author_avatar_emoji'],
                (string)$data['author_avatar_bg'],
                (string)$data['published_text'],
                (string)$data['preview'],
                (int)$data['replies_count'],
                (int)$data['views_count'],
                (int)$data['likes_count'],
                $sort,
            ]
        );
    }

    public function updateThread(int $id, array $data): bool
    {
        return $this->execute(
            "UPDATE forum_threads
             SET category = ?, title = ?, author = ?, author_avatar_emoji = ?, author_avatar_bg = ?,
                 published_text = ?, preview = ?, replies_count = ?, views_count = ?, likes_count = ?
             WHERE id = ?",
            'sssssssiiii',
            [
                (string)$data['category'],
                (string)$data['title'],
                (string)$data['author'],
                (string)$data['author_avatar_emoji'],
                (string)$data['author_avatar_bg'],
                (string)$data['published_text'],
                (string)$data['preview'],
                (int)$data['replies_count'],
                (int)$data['views_count'],
                (int)$data['likes_count'],
                $id,
            ]
        );
    }

    public function deleteThread(int $id): bool
    {
        return $this->execute("DELETE FROM forum_threads WHERE id = ?", 'i', [$id]);
    }

    public function getEvents(): array
    {
        return $this->fetchAll("SELECT id, event_date, title, description, tag FROM events ORDER BY sort_order ASC, id ASC");
    }

    public function getEventById(int $id): ?array
    {
        return $this->fetchOne("SELECT * FROM events WHERE id = ? LIMIT 1", 'i', [$id]);
    }

    public function addEvent(array $data): bool
    {
        $sort = $this->nextSort('events');
        return $this->execute(
            "INSERT INTO events (event_date, title, description, tag, sort_order) VALUES (?, ?, ?, ?, ?)",
            'ssssi',
            [(string)$data['event_date'], (string)$data['title'], (string)$data['description'], (string)$data['tag'], $sort]
        );
    }

    public function updateEvent(int $id, array $data): bool
    {
        return $this->execute(
            "UPDATE events SET event_date = ?, title = ?, description = ?, tag = ? WHERE id = ?",
            'ssssi',
            [(string)$data['event_date'], (string)$data['title'], (string)$data['description'], (string)$data['tag'], $id]
        );
    }

    public function deleteEvent(int $id): bool
    {
        return $this->execute("DELETE FROM events WHERE id = ?", 'i', [$id]);
    }

    public function getMembers(): array
    {
        return $this->fetchAll("SELECT id, name, avatar_emoji, avatar_bg, posts_count FROM members ORDER BY sort_order ASC, id ASC");
    }

    public function addMember(array $data): bool
    {
        $sort = $this->nextSort('members');
        return $this->execute(
            "INSERT INTO members (name, avatar_emoji, avatar_bg, posts_count, sort_order) VALUES (?, ?, ?, ?, ?)",
            'sssii',
            [(string)$data['name'], (string)$data['avatar_emoji'], (string)$data['avatar_bg'], (int)$data['posts_count'], $sort]
        );
    }

    public function deleteMember(int $id): bool
    {
        return $this->execute("DELETE FROM members WHERE id = ?", 'i', [$id]);
    }

    public function getTags(): array
    {
        return $this->fetchAll("SELECT id, tag FROM topic_tags ORDER BY sort_order ASC, id ASC");
    }

    public function addTag(string $tag): bool
    {
        $sort = $this->nextSort('topic_tags');
        return $this->execute("INSERT INTO topic_tags (tag, sort_order) VALUES (?, ?)", 'si', [$tag, $sort]);
    }

    public function deleteTag(int $id): bool
    {
        return $this->execute("DELETE FROM topic_tags WHERE id = ?", 'i', [$id]);
    }

    public function countThreads(): int
    {
        return $this->scalarCount("SELECT COUNT(*) AS total FROM forum_threads");
    }

    public function countEvents(): int
    {
        return $this->scalarCount("SELECT COUNT(*) AS total FROM events");
    }

    private function nextSort(string $table): int
    {
        $allowed = ['forum_threads', 'events', 'members', 'topic_tags'];
        if (!in_array($table, $allowed, true)) {
            throw new InvalidArgumentException('Invalid sort table.');
        }

        $row = $this->db->query("SELECT COALESCE(MAX(sort_order), 0) + 1 AS next_order FROM {$table}")->fetch_assoc();
        return (int)($row['next_order'] ?? 1);
    }
}
