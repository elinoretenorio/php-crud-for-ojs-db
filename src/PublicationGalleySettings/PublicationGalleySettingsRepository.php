<?php

declare(strict_types=1);

namespace OJS\PublicationGalleySettings;

use OJS\Database\IDatabase;
use OJS\Database\DatabaseException;

class PublicationGalleySettingsRepository implements IPublicationGalleySettingsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(PublicationGalleySettingsDto $dto): int
    {
        $sql = "INSERT INTO `publication_galley_settings` (`galley_id`, `locale`, `setting_name`, `setting_value`)
                VALUES (?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->galleyId,
                $dto->locale,
                $dto->settingName,
                $dto->settingValue
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(PublicationGalleySettingsDto $dto): int
    {
        $sql = "UPDATE `publication_galley_settings` SET `galley_id` = ?, `locale` = ?, `setting_name` = ?, `setting_value` = ?
                WHERE `publication_galley_setting_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->galleyId,
                $dto->locale,
                $dto->settingName,
                $dto->settingValue,
                $dto->publicationGalleySettingId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $publicationGalleySettingId): ?PublicationGalleySettingsDto
    {
        $sql = "SELECT `publication_galley_setting_id`, `galley_id`, `locale`, `setting_name`, `setting_value`
                FROM `publication_galley_settings` WHERE `publication_galley_setting_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$publicationGalleySettingId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new PublicationGalleySettingsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `publication_galley_setting_id`, `galley_id`, `locale`, `setting_name`, `setting_value`
                FROM `publication_galley_settings`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new PublicationGalleySettingsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $publicationGalleySettingId): int
    {
        $sql = "DELETE FROM `publication_galley_settings` WHERE `publication_galley_setting_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$publicationGalleySettingId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}