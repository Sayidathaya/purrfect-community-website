<?php

require_once BASE_PATH . '/app/core/Model.php';

class GaleriModel extends Model
{
    public function getAll(): array
    {
        $races = $this->fetchAll("SELECT id, name, origin, description, category, emoji, color_bg FROM cat_races ORDER BY sort_order ASC, id ASC");
        foreach ($races as &$race) {
            $race['traits'] = $this->getTraitsByRaceId((int)$race['id']);
        }
        unset($race);

        return $races;
    }

    public function getById(int $id): ?array
    {
        return $this->fetchOne(
            "SELECT id, name, origin, description, category, emoji, color_bg FROM cat_races WHERE id = ? LIMIT 1",
            'i',
            [$id]
        );
    }

    public function getTraitsByRaceId(int $id): array
    {
        $rows = $this->fetchAll(
            "SELECT trait FROM cat_race_traits WHERE race_id = ? ORDER BY sort_order ASC, id ASC",
            'i',
            [$id]
        );

        return array_map(static fn(array $row): string => (string)$row['trait'], $rows);
    }

    public function add(array $data): bool
    {
        $sort = $this->nextSort();
        return $this->execute(
            "INSERT INTO cat_races (name, origin, description, category, emoji, color_bg, sort_order)
             VALUES (?, ?, ?, ?, ?, ?, ?)",
            'ssssssi',
            [
                (string)$data['name'],
                (string)$data['origin'],
                (string)$data['description'],
                (string)$data['category'],
                (string)$data['emoji'],
                (string)$data['color_bg'],
                $sort,
            ]
        );
    }

    public function update(int $id, array $data): bool
    {
        return $this->execute(
            "UPDATE cat_races
             SET name = ?, origin = ?, description = ?, category = ?, emoji = ?, color_bg = ?
             WHERE id = ?",
            'ssssssi',
            [
                (string)$data['name'],
                (string)$data['origin'],
                (string)$data['description'],
                (string)$data['category'],
                (string)$data['emoji'],
                (string)$data['color_bg'],
                $id,
            ]
        );
    }

    public function delete(int $id): bool
    {
        return $this->execute("DELETE FROM cat_races WHERE id = ?", 'i', [$id]);
    }

    public function replaceTraits(int $raceId, array $traits): bool
    {
        $this->execute("DELETE FROM cat_race_traits WHERE race_id = ?", 'i', [$raceId]);
        $sort = 1;
        foreach ($traits as $trait) {
            $trait = trim((string)$trait);
            if ($trait === '') {
                continue;
            }
            $this->execute(
                "INSERT INTO cat_race_traits (race_id, trait, sort_order) VALUES (?, ?, ?)",
                'isi',
                [$raceId, $trait, $sort]
            );
            $sort++;
        }

        return true;
    }

    public function countAll(): int
    {
        return $this->scalarCount("SELECT COUNT(*) AS total FROM cat_races");
    }

    public function lastInsertId(): int
    {
        return (int)$this->db->insert_id;
    }

    private function nextSort(): int
    {
        $row = $this->db->query("SELECT COALESCE(MAX(sort_order), 0) + 1 AS next_order FROM cat_races")->fetch_assoc();
        return (int)($row['next_order'] ?? 1);
    }
}
