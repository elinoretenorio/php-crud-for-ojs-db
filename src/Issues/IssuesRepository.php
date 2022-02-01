<?php

declare(strict_types=1);

namespace OJS\Issues;

use OJS\Database\IDatabase;
use OJS\Database\DatabaseException;

class IssuesRepository implements IIssuesRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(IssuesDto $dto): int
    {
        $sql = "INSERT INTO `issues` (`journal_id`, `volume`, `number`, `year`, `published`, `date_published`, `date_notified`, `last_modified`, `access_status`, `open_access_date`, `show_volume`, `show_number`, `show_year`, `show_title`, `style_file_name`, `original_style_file_name`, `url_path`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->journalId,
                $dto->volume,
                $dto->number,
                $dto->year,
                $dto->published,
                $dto->datePublished,
                $dto->dateNotified,
                $dto->lastModified,
                $dto->accessStatus,
                $dto->openAccessDate,
                $dto->showVolume,
                $dto->showNumber,
                $dto->showYear,
                $dto->showTitle,
                $dto->styleFileName,
                $dto->originalStyleFileName,
                $dto->urlPath
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(IssuesDto $dto): int
    {
        $sql = "UPDATE `issues` SET `journal_id` = ?, `volume` = ?, `number` = ?, `year` = ?, `published` = ?, `date_published` = ?, `date_notified` = ?, `last_modified` = ?, `access_status` = ?, `open_access_date` = ?, `show_volume` = ?, `show_number` = ?, `show_year` = ?, `show_title` = ?, `style_file_name` = ?, `original_style_file_name` = ?, `url_path` = ?
                WHERE `issue_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->journalId,
                $dto->volume,
                $dto->number,
                $dto->year,
                $dto->published,
                $dto->datePublished,
                $dto->dateNotified,
                $dto->lastModified,
                $dto->accessStatus,
                $dto->openAccessDate,
                $dto->showVolume,
                $dto->showNumber,
                $dto->showYear,
                $dto->showTitle,
                $dto->styleFileName,
                $dto->originalStyleFileName,
                $dto->urlPath,
                $dto->issueId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $issueId): ?IssuesDto
    {
        $sql = "SELECT `issue_id`, `journal_id`, `volume`, `number`, `year`, `published`, `date_published`, `date_notified`, `last_modified`, `access_status`, `open_access_date`, `show_volume`, `show_number`, `show_year`, `show_title`, `style_file_name`, `original_style_file_name`, `url_path`
                FROM `issues` WHERE `issue_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$issueId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new IssuesDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `issue_id`, `journal_id`, `volume`, `number`, `year`, `published`, `date_published`, `date_notified`, `last_modified`, `access_status`, `open_access_date`, `show_volume`, `show_number`, `show_year`, `show_title`, `style_file_name`, `original_style_file_name`, `url_path`
                FROM `issues`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new IssuesDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $issueId): int
    {
        $sql = "DELETE FROM `issues` WHERE `issue_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$issueId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}