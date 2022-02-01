<?php

declare(strict_types=1);

namespace OJS\IssueSettings;

use OJS\Database\IDatabase;
use OJS\Database\DatabaseException;

class IssueSettingsRepository implements IIssueSettingsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(IssueSettingsDto $dto): int
    {
        $sql = "INSERT INTO `issue_settings` (`issue_id`, `locale`, `setting_name`, `setting_value`, `setting_type`)
                VALUES (?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->issueId,
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

    public function update(IssueSettingsDto $dto): int
    {
        $sql = "UPDATE `issue_settings` SET `issue_id` = ?, `locale` = ?, `setting_name` = ?, `setting_value` = ?, `setting_type` = ?
                WHERE `issue_setting_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->issueId,
                $dto->locale,
                $dto->settingName,
                $dto->settingValue,
                $dto->settingType,
                $dto->issueSettingId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $issueSettingId): ?IssueSettingsDto
    {
        $sql = "SELECT `issue_setting_id`, `issue_id`, `locale`, `setting_name`, `setting_value`, `setting_type`
                FROM `issue_settings` WHERE `issue_setting_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$issueSettingId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new IssueSettingsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `issue_setting_id`, `issue_id`, `locale`, `setting_name`, `setting_value`, `setting_type`
                FROM `issue_settings`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new IssueSettingsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $issueSettingId): int
    {
        $sql = "DELETE FROM `issue_settings` WHERE `issue_setting_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$issueSettingId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}