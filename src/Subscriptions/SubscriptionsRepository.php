<?php

declare(strict_types=1);

namespace OJS\Subscriptions;

use OJS\Database\IDatabase;
use OJS\Database\DatabaseException;

class SubscriptionsRepository implements ISubscriptionsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(SubscriptionsDto $dto): int
    {
        $sql = "INSERT INTO `subscriptions` (`journal_id`, `user_id`, `type_id`, `date_start`, `date_end`, `status`, `membership`, `reference_number`, `notes`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->journalId,
                $dto->userId,
                $dto->typeId,
                $dto->dateStart,
                $dto->dateEnd,
                $dto->status,
                $dto->membership,
                $dto->referenceNumber,
                $dto->notes
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(SubscriptionsDto $dto): int
    {
        $sql = "UPDATE `subscriptions` SET `journal_id` = ?, `user_id` = ?, `type_id` = ?, `date_start` = ?, `date_end` = ?, `status` = ?, `membership` = ?, `reference_number` = ?, `notes` = ?
                WHERE `subscription_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->journalId,
                $dto->userId,
                $dto->typeId,
                $dto->dateStart,
                $dto->dateEnd,
                $dto->status,
                $dto->membership,
                $dto->referenceNumber,
                $dto->notes,
                $dto->subscriptionId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $subscriptionId): ?SubscriptionsDto
    {
        $sql = "SELECT `subscription_id`, `journal_id`, `user_id`, `type_id`, `date_start`, `date_end`, `status`, `membership`, `reference_number`, `notes`
                FROM `subscriptions` WHERE `subscription_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$subscriptionId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new SubscriptionsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `subscription_id`, `journal_id`, `user_id`, `type_id`, `date_start`, `date_end`, `status`, `membership`, `reference_number`, `notes`
                FROM `subscriptions`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new SubscriptionsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $subscriptionId): int
    {
        $sql = "DELETE FROM `subscriptions` WHERE `subscription_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$subscriptionId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}