<?php

declare(strict_types=1);

namespace OJS\CustomSectionOrders;

use OJS\Database\IDatabase;
use OJS\Database\DatabaseException;

class CustomSectionOrdersRepository implements ICustomSectionOrdersRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(CustomSectionOrdersDto $dto): int
    {
        $sql = "INSERT INTO `custom_section_orders` (`issue_id`, `section_id`, `seq`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->issueId,
                $dto->sectionId,
                $dto->seq
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(CustomSectionOrdersDto $dto): int
    {
        $sql = "UPDATE `custom_section_orders` SET `issue_id` = ?, `section_id` = ?, `seq` = ?
                WHERE `custom_section_order_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->issueId,
                $dto->sectionId,
                $dto->seq,
                $dto->customSectionOrderId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $customSectionOrderId): ?CustomSectionOrdersDto
    {
        $sql = "SELECT `custom_section_order_id`, `issue_id`, `section_id`, `seq`
                FROM `custom_section_orders` WHERE `custom_section_order_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$customSectionOrderId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new CustomSectionOrdersDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `custom_section_order_id`, `issue_id`, `section_id`, `seq`
                FROM `custom_section_orders`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new CustomSectionOrdersDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $customSectionOrderId): int
    {
        $sql = "DELETE FROM `custom_section_orders` WHERE `custom_section_order_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$customSectionOrderId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}