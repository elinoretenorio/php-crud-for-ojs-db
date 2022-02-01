<?php

declare(strict_types=1);

namespace OJS\IssueFiles;

use OJS\Database\IDatabase;
use OJS\Database\DatabaseException;

class IssueFilesRepository implements IIssueFilesRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(IssueFilesDto $dto): int
    {
        $sql = "INSERT INTO `issue_files` (`issue_id`, `file_name`, `file_type`, `file_size`, `content_type`, `original_file_name`, `date_uploaded`, `date_modified`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->issueId,
                $dto->fileName,
                $dto->fileType,
                $dto->fileSize,
                $dto->contentType,
                $dto->originalFileName,
                $dto->dateUploaded,
                $dto->dateModified
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(IssueFilesDto $dto): int
    {
        $sql = "UPDATE `issue_files` SET `issue_id` = ?, `file_name` = ?, `file_type` = ?, `file_size` = ?, `content_type` = ?, `original_file_name` = ?, `date_uploaded` = ?, `date_modified` = ?
                WHERE `file_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->issueId,
                $dto->fileName,
                $dto->fileType,
                $dto->fileSize,
                $dto->contentType,
                $dto->originalFileName,
                $dto->dateUploaded,
                $dto->dateModified,
                $dto->fileId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $fileId): ?IssueFilesDto
    {
        $sql = "SELECT `file_id`, `issue_id`, `file_name`, `file_type`, `file_size`, `content_type`, `original_file_name`, `date_uploaded`, `date_modified`
                FROM `issue_files` WHERE `file_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$fileId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new IssueFilesDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `file_id`, `issue_id`, `file_name`, `file_type`, `file_size`, `content_type`, `original_file_name`, `date_uploaded`, `date_modified`
                FROM `issue_files`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new IssueFilesDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $fileId): int
    {
        $sql = "DELETE FROM `issue_files` WHERE `file_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$fileId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}