<?php

declare(strict_types=1);

namespace OJS\SubscriptionTypes;

use OJS\Database\IDatabase;
use OJS\Database\DatabaseException;

class SubscriptionTypesRepository implements ISubscriptionTypesRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(SubscriptionTypesDto $dto): int
    {
        $sql = "INSERT INTO `subscription_types` (`journal_id`, `cost`, `currency_code_alpha`, `duration`, `format`, `institutional`, `membership`, `disable_public_display`, `seq`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->journalId,
                $dto->cost,
                $dto->currencyCodeAlpha,
                $dto->duration,
                $dto->format,
                $dto->institutional,
                $dto->membership,
                $dto->disablePublicDisplay,
                $dto->seq
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(SubscriptionTypesDto $dto): int
    {
        $sql = "UPDATE `subscription_types` SET `journal_id` = ?, `cost` = ?, `currency_code_alpha` = ?, `duration` = ?, `format` = ?, `institutional` = ?, `membership` = ?, `disable_public_display` = ?, `seq` = ?
                WHERE `type_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->journalId,
                $dto->cost,
                $dto->currencyCodeAlpha,
                $dto->duration,
                $dto->format,
                $dto->institutional,
                $dto->membership,
                $dto->disablePublicDisplay,
                $dto->seq,
                $dto->typeId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $typeId): ?SubscriptionTypesDto
    {
        $sql = "SELECT `type_id`, `journal_id`, `cost`, `currency_code_alpha`, `duration`, `format`, `institutional`, `membership`, `disable_public_display`, `seq`
                FROM `subscription_types` WHERE `type_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$typeId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new SubscriptionTypesDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `type_id`, `journal_id`, `cost`, `currency_code_alpha`, `duration`, `format`, `institutional`, `membership`, `disable_public_display`, `seq`
                FROM `subscription_types`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new SubscriptionTypesDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $typeId): int
    {
        $sql = "DELETE FROM `subscription_types` WHERE `type_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$typeId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}