<?php

declare(strict_types=1);

namespace OJS\IssueGalleys;

use OJS\Database\IDatabase;
use OJS\Database\DatabaseException;

class IssueGalleysRepository implements IIssueGalleysRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(IssueGalleysDto $dto): int
    {
        $sql = "INSERT INTO `issue_galleys` (`locale`, `issue_id`, `file_id`, `label`, `seq`, `url_path`)
                VALUES (?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->locale,
                $dto->issueId,
                $dto->fileId,
                $dto->label,
                $dto->seq,
                $dto->urlPath
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(IssueGalleysDto $dto): int
    {
        $sql = "UPDATE `issue_galleys` SET `locale` = ?, `issue_id` = ?, `file_id` = ?, `label` = ?, `seq` = ?, `url_path` = ?
                WHERE `galley_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->locale,
                $dto->issueId,
                $dto->fileId,
                $dto->label,
                $dto->seq,
                $dto->urlPath,
                $dto->galleyId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $galleyId): ?IssueGalleysDto
    {
        $sql = "SELECT `galley_id`, `locale`, `issue_id`, `file_id`, `label`, `seq`, `url_path`
                FROM `issue_galleys` WHERE `galley_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$galleyId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new IssueGalleysDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `galley_id`, `locale`, `issue_id`, `file_id`, `label`, `seq`, `url_path`
                FROM `issue_galleys`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new IssueGalleysDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $galleyId): int
    {
        $sql = "DELETE FROM `issue_galleys` WHERE `galley_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$galleyId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}