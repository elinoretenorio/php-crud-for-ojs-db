<?php

declare(strict_types=1);

namespace OJS\InstitutionalSubscriptions;

use OJS\Database\IDatabase;
use OJS\Database\DatabaseException;

class InstitutionalSubscriptionsRepository implements IInstitutionalSubscriptionsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(InstitutionalSubscriptionsDto $dto): int
    {
        $sql = "INSERT INTO `institutional_subscriptions` (`subscription_id`, `institution_name`, `mailing_address`, `domain`)
                VALUES (?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->subscriptionId,
                $dto->institutionName,
                $dto->mailingAddress,
                $dto->domain
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(InstitutionalSubscriptionsDto $dto): int
    {
        $sql = "UPDATE `institutional_subscriptions` SET `subscription_id` = ?, `institution_name` = ?, `mailing_address` = ?, `domain` = ?
                WHERE `institutional_subscription_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->subscriptionId,
                $dto->institutionName,
                $dto->mailingAddress,
                $dto->domain,
                $dto->institutionalSubscriptionId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $institutionalSubscriptionId): ?InstitutionalSubscriptionsDto
    {
        $sql = "SELECT `institutional_subscription_id`, `subscription_id`, `institution_name`, `mailing_address`, `domain`
                FROM `institutional_subscriptions` WHERE `institutional_subscription_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$institutionalSubscriptionId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new InstitutionalSubscriptionsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `institutional_subscription_id`, `subscription_id`, `institution_name`, `mailing_address`, `domain`
                FROM `institutional_subscriptions`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new InstitutionalSubscriptionsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $institutionalSubscriptionId): int
    {
        $sql = "DELETE FROM `institutional_subscriptions` WHERE `institutional_subscription_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$institutionalSubscriptionId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}