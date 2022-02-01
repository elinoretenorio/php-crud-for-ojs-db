<?php

declare(strict_types=1);

namespace OJS\PublicationGalleys;

use OJS\Database\IDatabase;
use OJS\Database\DatabaseException;

class PublicationGalleysRepository implements IPublicationGalleysRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(PublicationGalleysDto $dto): int
    {
        $sql = "INSERT INTO `publication_galleys` (`locale`, `publication_id`, `label`, `submission_file_id`, `seq`, `remote_url`, `is_approved`, `url_path`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->locale,
                $dto->publicationId,
                $dto->label,
                $dto->submissionFileId,
                $dto->seq,
                $dto->remoteUrl,
                $dto->isApproved,
                $dto->urlPath
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(PublicationGalleysDto $dto): int
    {
        $sql = "UPDATE `publication_galleys` SET `locale` = ?, `publication_id` = ?, `label` = ?, `submission_file_id` = ?, `seq` = ?, `remote_url` = ?, `is_approved` = ?, `url_path` = ?
                WHERE `galley_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->locale,
                $dto->publicationId,
                $dto->label,
                $dto->submissionFileId,
                $dto->seq,
                $dto->remoteUrl,
                $dto->isApproved,
                $dto->urlPath,
                $dto->galleyId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $galleyId): ?PublicationGalleysDto
    {
        $sql = "SELECT `galley_id`, `locale`, `publication_id`, `label`, `submission_file_id`, `seq`, `remote_url`, `is_approved`, `url_path`
                FROM `publication_galleys` WHERE `galley_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$galleyId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new PublicationGalleysDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `galley_id`, `locale`, `publication_id`, `label`, `submission_file_id`, `seq`, `remote_url`, `is_approved`, `url_path`
                FROM `publication_galleys`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new PublicationGalleysDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $galleyId): int
    {
        $sql = "DELETE FROM `publication_galleys` WHERE `galley_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$galleyId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}