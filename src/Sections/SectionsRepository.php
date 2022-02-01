<?php

declare(strict_types=1);

namespace OJS\Sections;

use OJS\Database\IDatabase;
use OJS\Database\DatabaseException;

class SectionsRepository implements ISectionsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(SectionsDto $dto): int
    {
        $sql = "INSERT INTO `sections` (`journal_id`, `review_form_id`, `seq`, `editor_restricted`, `meta_indexed`, `meta_reviewed`, `abstracts_not_required`, `hide_title`, `hide_author`, `is_inactive`, `abstract_word_count`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->journalId,
                $dto->reviewFormId,
                $dto->seq,
                $dto->editorRestricted,
                $dto->metaIndexed,
                $dto->metaReviewed,
                $dto->abstractsNotRequired,
                $dto->hideTitle,
                $dto->hideAuthor,
                $dto->isInactive,
                $dto->abstractWordCount
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(SectionsDto $dto): int
    {
        $sql = "UPDATE `sections` SET `journal_id` = ?, `review_form_id` = ?, `seq` = ?, `editor_restricted` = ?, `meta_indexed` = ?, `meta_reviewed` = ?, `abstracts_not_required` = ?, `hide_title` = ?, `hide_author` = ?, `is_inactive` = ?, `abstract_word_count` = ?
                WHERE `section_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->journalId,
                $dto->reviewFormId,
                $dto->seq,
                $dto->editorRestricted,
                $dto->metaIndexed,
                $dto->metaReviewed,
                $dto->abstractsNotRequired,
                $dto->hideTitle,
                $dto->hideAuthor,
                $dto->isInactive,
                $dto->abstractWordCount,
                $dto->sectionId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $sectionId): ?SectionsDto
    {
        $sql = "SELECT `section_id`, `journal_id`, `review_form_id`, `seq`, `editor_restricted`, `meta_indexed`, `meta_reviewed`, `abstracts_not_required`, `hide_title`, `hide_author`, `is_inactive`, `abstract_word_count`
                FROM `sections` WHERE `section_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$sectionId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new SectionsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `section_id`, `journal_id`, `review_form_id`, `seq`, `editor_restricted`, `meta_indexed`, `meta_reviewed`, `abstracts_not_required`, `hide_title`, `hide_author`, `is_inactive`, `abstract_word_count`
                FROM `sections`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new SectionsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $sectionId): int
    {
        $sql = "DELETE FROM `sections` WHERE `section_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$sectionId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}