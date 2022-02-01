<?php

declare(strict_types=1);

namespace OJS\Publications;

use OJS\Database\IDatabase;
use OJS\Database\DatabaseException;

class PublicationsRepository implements IPublicationsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(PublicationsDto $dto): int
    {
        $sql = "INSERT INTO `publications` (`access_status`, `date_published`, `last_modified`, `primary_contact_id`, `section_id`, `seq`, `submission_id`, `status`, `url_path`, `version`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->accessStatus,
                $dto->datePublished,
                $dto->lastModified,
                $dto->primaryContactId,
                $dto->sectionId,
                $dto->seq,
                $dto->submissionId,
                $dto->status,
                $dto->urlPath,
                $dto->version
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(PublicationsDto $dto): int
    {
        $sql = "UPDATE `publications` SET `access_status` = ?, `date_published` = ?, `last_modified` = ?, `primary_contact_id` = ?, `section_id` = ?, `seq` = ?, `submission_id` = ?, `status` = ?, `url_path` = ?, `version` = ?
                WHERE `publication_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->accessStatus,
                $dto->datePublished,
                $dto->lastModified,
                $dto->primaryContactId,
                $dto->sectionId,
                $dto->seq,
                $dto->submissionId,
                $dto->status,
                $dto->urlPath,
                $dto->version,
                $dto->publicationId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $publicationId): ?PublicationsDto
    {
        $sql = "SELECT `publication_id`, `access_status`, `date_published`, `last_modified`, `primary_contact_id`, `section_id`, `seq`, `submission_id`, `status`, `url_path`, `version`
                FROM `publications` WHERE `publication_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$publicationId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new PublicationsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `publication_id`, `access_status`, `date_published`, `last_modified`, `primary_contact_id`, `section_id`, `seq`, `submission_id`, `status`, `url_path`, `version`
                FROM `publications`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new PublicationsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $publicationId): int
    {
        $sql = "DELETE FROM `publications` WHERE `publication_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$publicationId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}