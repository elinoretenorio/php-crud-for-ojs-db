<?php

declare(strict_types=1);

namespace OJS\InstitutionalSubscriptionIp;

use OJS\Database\IDatabase;
use OJS\Database\DatabaseException;

class InstitutionalSubscriptionIpRepository implements IInstitutionalSubscriptionIpRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(InstitutionalSubscriptionIpDto $dto): int
    {
        $sql = "INSERT INTO `institutional_subscription_ip` (`subscription_id`, `ip_string`, `ip_start`, `ip_end`)
                VALUES (?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->subscriptionId,
                $dto->ipString,
                $dto->ipStart,
                $dto->ipEnd
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(InstitutionalSubscriptionIpDto $dto): int
    {
        $sql = "UPDATE `institutional_subscription_ip` SET `subscription_id` = ?, `ip_string` = ?, `ip_start` = ?, `ip_end` = ?
                WHERE `institutional_subscription_ip_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->subscriptionId,
                $dto->ipString,
                $dto->ipStart,
                $dto->ipEnd,
                $dto->institutionalSubscriptionIpId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $institutionalSubscriptionIpId): ?InstitutionalSubscriptionIpDto
    {
        $sql = "SELECT `institutional_subscription_ip_id`, `subscription_id`, `ip_string`, `ip_start`, `ip_end`
                FROM `institutional_subscription_ip` WHERE `institutional_subscription_ip_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$institutionalSubscriptionIpId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new InstitutionalSubscriptionIpDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `institutional_subscription_ip_id`, `subscription_id`, `ip_string`, `ip_start`, `ip_end`
                FROM `institutional_subscription_ip`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new InstitutionalSubscriptionIpDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $institutionalSubscriptionIpId): int
    {
        $sql = "DELETE FROM `institutional_subscription_ip` WHERE `institutional_subscription_ip_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$institutionalSubscriptionIpId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}