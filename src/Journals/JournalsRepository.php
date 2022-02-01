<?php

declare(strict_types=1);

namespace OJS\Journals;

use OJS\Database\IDatabase;
use OJS\Database\DatabaseException;

class JournalsRepository implements IJournalsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(JournalsDto $dto): int
    {
        $sql = "INSERT INTO `journals` (`path`, `seq`, `primary_locale`, `enabled`, `current_issue_id`)
                VALUES (?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->path,
                $dto->seq,
                $dto->primaryLocale,
                $dto->enabled,
                $dto->currentIssueId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(JournalsDto $dto): int
    {
        $sql = "UPDATE `journals` SET `path` = ?, `seq` = ?, `primary_locale` = ?, `enabled` = ?, `current_issue_id` = ?
                WHERE `journal_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->path,
                $dto->seq,
                $dto->primaryLocale,
                $dto->enabled,
                $dto->currentIssueId,
                $dto->journalId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $journalId): ?JournalsDto
    {
        $sql = "SELECT `journal_id`, `path`, `seq`, `primary_locale`, `enabled`, `current_issue_id`
                FROM `journals` WHERE `journal_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$journalId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new JournalsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `journal_id`, `path`, `seq`, `primary_locale`, `enabled`, `current_issue_id`
                FROM `journals`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new JournalsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $journalId): int
    {
        $sql = "DELETE FROM `journals` WHERE `journal_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$journalId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}