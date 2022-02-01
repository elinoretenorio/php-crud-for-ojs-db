<?php

declare(strict_types=1);

namespace OJS\CustomIssueOrders;

use OJS\Database\IDatabase;
use OJS\Database\DatabaseException;

class CustomIssueOrdersRepository implements ICustomIssueOrdersRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(CustomIssueOrdersDto $dto): int
    {
        $sql = "INSERT INTO `custom_issue_orders` (`issue_id`, `journal_id`, `seq`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->issueId,
                $dto->journalId,
                $dto->seq
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(CustomIssueOrdersDto $dto): int
    {
        $sql = "UPDATE `custom_issue_orders` SET `issue_id` = ?, `journal_id` = ?, `seq` = ?
                WHERE `custom_issue_order_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->issueId,
                $dto->journalId,
                $dto->seq,
                $dto->customIssueOrderId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $customIssueOrderId): ?CustomIssueOrdersDto
    {
        $sql = "SELECT `custom_issue_order_id`, `issue_id`, `journal_id`, `seq`
                FROM `custom_issue_orders` WHERE `custom_issue_order_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$customIssueOrderId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new CustomIssueOrdersDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `custom_issue_order_id`, `issue_id`, `journal_id`, `seq`
                FROM `custom_issue_orders`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new CustomIssueOrdersDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $customIssueOrderId): int
    {
        $sql = "DELETE FROM `custom_issue_orders` WHERE `custom_issue_order_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$customIssueOrderId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}