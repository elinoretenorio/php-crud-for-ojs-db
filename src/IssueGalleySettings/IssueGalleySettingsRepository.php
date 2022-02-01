<?php

declare(strict_types=1);

namespace OJS\IssueGalleySettings;

use OJS\Database\IDatabase;
use OJS\Database\DatabaseException;

class IssueGalleySettingsRepository implements IIssueGalleySettingsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(IssueGalleySettingsDto $dto): int
    {
        $sql = "INSERT INTO `issue_galley_settings` (`issue_galley_setting_id`, `locale`, `setting_name`, `setting_value`, `setting_type`)
                VALUES (?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->issueGalleySettingId,
                $dto->locale,
                $dto->settingName,
                $dto->settingValue,
                $dto->settingType
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(IssueGalleySettingsDto $dto): int
    {
        $sql = "UPDATE `issue_galley_settings` SET `issue_galley_setting_id` = ?, `locale` = ?, `setting_name` = ?, `setting_value` = ?, `setting_type` = ?
                WHERE `galley_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->issueGalleySettingId,
                $dto->locale,
                $dto->settingName,
                $dto->settingValue,
                $dto->settingType,
                $dto->galleyId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $galleyId): ?IssueGalleySettingsDto
    {
        $sql = "SELECT `issue_galley_setting_id`, `galley_id`, `locale`, `setting_name`, `setting_value`, `setting_type`
                FROM `issue_galley_settings` WHERE `galley_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$galleyId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new IssueGalleySettingsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `issue_galley_setting_id`, `galley_id`, `locale`, `setting_name`, `setting_value`, `setting_type`
                FROM `issue_galley_settings`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new IssueGalleySettingsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $galleyId): int
    {
        $sql = "DELETE FROM `issue_galley_settings` WHERE `galley_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$galleyId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}