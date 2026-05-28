<?php

require_once BASE_PATH . '/app/core/Model.php';

class KontakModel extends Model
{
    public function getContactInfo(): ?array
    {
        return $this->fetchOne(
            "SELECT id, email_primary, email_secondary, location, hours_weekdays, hours_saturday,
                    social_instagram, social_whatsapp, social_youtube, social_tiktok
             FROM contact_info
             ORDER BY id ASC
             LIMIT 1"
        );
    }

    public function updateContactInfo(array $data): bool
    {
        return $this->execute(
            "INSERT INTO contact_info
             (id, email_primary, email_secondary, location, hours_weekdays, hours_saturday,
              social_instagram, social_whatsapp, social_youtube, social_tiktok)
             VALUES (1, ?, ?, ?, ?, ?, ?, ?, ?, ?)
             ON DUPLICATE KEY UPDATE
              email_primary = ?, email_secondary = ?, location = ?, hours_weekdays = ?, hours_saturday = ?,
              social_instagram = ?, social_whatsapp = ?, social_youtube = ?, social_tiktok = ?",
            'ssssssssssssssssss',
            [
                (string)$data['email_primary'],
                (string)$data['email_secondary'],
                (string)$data['location'],
                (string)$data['hours_weekdays'],
                (string)$data['hours_saturday'],
                (string)$data['social_instagram'],
                (string)$data['social_whatsapp'],
                (string)$data['social_youtube'],
                (string)$data['social_tiktok'],
                (string)$data['email_primary'],
                (string)$data['email_secondary'],
                (string)$data['location'],
                (string)$data['hours_weekdays'],
                (string)$data['hours_saturday'],
                (string)$data['social_instagram'],
                (string)$data['social_whatsapp'],
                (string)$data['social_youtube'],
                (string)$data['social_tiktok'],
            ]
        );
    }

    public function getFaqs(): array
    {
        return $this->fetchAll("SELECT id, question, answer FROM faqs ORDER BY sort_order ASC, id ASC");
    }

    public function addFaq(string $q, string $a): bool
    {
        $row = $this->db->query("SELECT COALESCE(MAX(sort_order), 0) + 1 AS next_order FROM faqs")->fetch_assoc();
        $sort = (int)($row['next_order'] ?? 1);
        return $this->execute("INSERT INTO faqs (question, answer, sort_order) VALUES (?, ?, ?)", 'ssi', [$q, $a, $sort]);
    }

    public function updateFaq(int $id, string $q, string $a): bool
    {
        return $this->execute("UPDATE faqs SET question = ?, answer = ? WHERE id = ?", 'ssi', [$q, $a, $id]);
    }

    public function deleteFaq(int $id): bool
    {
        return $this->execute("DELETE FROM faqs WHERE id = ?", 'i', [$id]);
    }

    public function getMessages(): array
    {
        return $this->fetchAll("SELECT id, name, email, topic, message, created_at, is_read FROM contact_messages ORDER BY created_at DESC, id DESC");
    }

    public function getLatestMessages(int $limit = 5): array
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

    public function addMessage(string $name, string $email, string $topic, string $msg): bool
    {
        return $this->execute(
            "INSERT INTO contact_messages (name, email, topic, message, is_read) VALUES (?, ?, ?, ?, 0)",
            'ssss',
            [$name, $email, $topic, $msg]
        );
    }

    public function deleteMessage(int $id): bool
    {
        return $this->execute("DELETE FROM contact_messages WHERE id = ?", 'i', [$id]);
    }

    public function countUnread(): int
    {
        return $this->scalarCount("SELECT COUNT(*) AS total FROM contact_messages WHERE is_read = 0");
    }

    public function markAllRead(): bool
    {
        return $this->execute("UPDATE contact_messages SET is_read = 1 WHERE is_read = 0");
    }
}
