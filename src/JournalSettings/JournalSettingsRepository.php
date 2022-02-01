<?php

declare(strict_types=1);

namespace OJS\JournalSettings;

use OJS\Database\IDatabase;
use OJS\Database\DatabaseException;

class JournalSettingsRepository implements IJournalSettingsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(JournalSettingsDto $dto): int
    {
        $sql = "INSERT INTO `journal_settings` (`journal_id`, `locale`, `setting_name`, `setting_value`, `setting_type`)
                VALUES (?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->journalId,
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

    public function update(JournalSettingsDto $dto): int
    {
        $sql = "UPDATE `journal_settings` SET `journal_id` = ?, `locale` = ?, `setting_name` = ?, `setting_value` = ?, `setting_type` = ?
                WHERE `journal_setting_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->journalId,
                $dto->locale,
                $dto->settingName,
                $dto->settingValue,
                $dto->settingType,
                $dto->journalSettingId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $journalSettingId): ?JournalSettingsDto
    {
        $sql = "SELECT `journal_setting_id`, `journal_id`, `locale`, `setting_name`, `setting_value`, `setting_type`
                FROM `journal_settings` WHERE `journal_setting_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$journalSettingId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new JournalSettingsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `journal_setting_id`, `journal_id`, `locale`, `setting_name`, `setting_value`, `setting_type`
                FROM `journal_settings`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new JournalSettingsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $journalSettingId): int
    {
        $sql = "DELETE FROM `journal_settings` WHERE `journal_setting_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$journalSettingId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}