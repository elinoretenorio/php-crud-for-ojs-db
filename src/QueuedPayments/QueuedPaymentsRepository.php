<?php

declare(strict_types=1);

namespace OJS\QueuedPayments;

use OJS\Database\IDatabase;
use OJS\Database\DatabaseException;

class QueuedPaymentsRepository implements IQueuedPaymentsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(QueuedPaymentsDto $dto): int
    {
        $sql = "INSERT INTO `queued_payments` (`date_created`, `date_modified`, `expiry_date`, `payment_data`)
                VALUES (?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->dateCreated,
                $dto->dateModified,
                $dto->expiryDate,
                $dto->paymentData
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(QueuedPaymentsDto $dto): int
    {
        $sql = "UPDATE `queued_payments` SET `date_created` = ?, `date_modified` = ?, `expiry_date` = ?, `payment_data` = ?
                WHERE `queued_payment_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->dateCreated,
                $dto->dateModified,
                $dto->expiryDate,
                $dto->paymentData,
                $dto->queuedPaymentId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $queuedPaymentId): ?QueuedPaymentsDto
    {
        $sql = "SELECT `queued_payment_id`, `date_created`, `date_modified`, `expiry_date`, `payment_data`
                FROM `queued_payments` WHERE `queued_payment_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$queuedPaymentId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new QueuedPaymentsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `queued_payment_id`, `date_created`, `date_modified`, `expiry_date`, `payment_data`
                FROM `queued_payments`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new QueuedPaymentsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $queuedPaymentId): int
    {
        $sql = "DELETE FROM `queued_payments` WHERE `queued_payment_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$queuedPaymentId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}