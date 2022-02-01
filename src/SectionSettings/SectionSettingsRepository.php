<?php

declare(strict_types=1);

namespace OJS\SectionSettings;

use OJS\Database\IDatabase;
use OJS\Database\DatabaseException;

class SectionSettingsRepository implements ISectionSettingsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(SectionSettingsDto $dto): int
    {
        $sql = "INSERT INTO `section_settings` (`section_id`, `locale`, `setting_name`, `setting_value`, `setting_type`)
                VALUES (?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->sectionId,
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

    public function update(SectionSettingsDto $dto): int
    {
        $sql = "UPDATE `section_settings` SET `section_id` = ?, `locale` = ?, `setting_name` = ?, `setting_value` = ?, `setting_type` = ?
                WHERE `section_setting_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->sectionId,
                $dto->locale,
                $dto->settingName,
                $dto->settingValue,
                $dto->settingType,
                $dto->sectionSettingId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $sectionSettingId): ?SectionSettingsDto
    {
        $sql = "SELECT `section_setting_id`, `section_id`, `locale`, `setting_name`, `setting_value`, `setting_type`
                FROM `section_settings` WHERE `section_setting_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$sectionSettingId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new SectionSettingsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `section_setting_id`, `section_id`, `locale`, `setting_name`, `setting_value`, `setting_type`
                FROM `section_settings`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new SectionSettingsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $sectionSettingId): int
    {
        $sql = "DELETE FROM `section_settings` WHERE `section_setting_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$sectionSettingId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}