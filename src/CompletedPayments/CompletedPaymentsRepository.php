<?php

declare(strict_types=1);

namespace OJS\CompletedPayments;

use OJS\Database\IDatabase;
use OJS\Database\DatabaseException;

class CompletedPaymentsRepository implements ICompletedPaymentsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(CompletedPaymentsDto $dto): int
    {
        $sql = "INSERT INTO `completed_payments` (`timestamp`, `payment_type`, `context_id`, `user_id`, `assoc_id`, `amount`, `currency_code_alpha`, `payment_method_plugin_name`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->timestamp,
                $dto->paymentType,
                $dto->contextId,
                $dto->userId,
                $dto->assocId,
                $dto->amount,
                $dto->currencyCodeAlpha,
                $dto->paymentMethodPluginName
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(CompletedPaymentsDto $dto): int
    {
        $sql = "UPDATE `completed_payments` SET `timestamp` = ?, `payment_type` = ?, `context_id` = ?, `user_id` = ?, `assoc_id` = ?, `amount` = ?, `currency_code_alpha` = ?, `payment_method_plugin_name` = ?
                WHERE `completed_payment_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->timestamp,
                $dto->paymentType,
                $dto->contextId,
                $dto->userId,
                $dto->assocId,
                $dto->amount,
                $dto->currencyCodeAlpha,
                $dto->paymentMethodPluginName,
                $dto->completedPaymentId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $completedPaymentId): ?CompletedPaymentsDto
    {
        $sql = "SELECT `completed_payment_id`, `timestamp`, `payment_type`, `context_id`, `user_id`, `assoc_id`, `amount`, `currency_code_alpha`, `payment_method_plugin_name`
                FROM `completed_payments` WHERE `completed_payment_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$completedPaymentId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new CompletedPaymentsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `completed_payment_id`, `timestamp`, `payment_type`, `context_id`, `user_id`, `assoc_id`, `amount`, `currency_code_alpha`, `payment_method_plugin_name`
                FROM `completed_payments`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new CompletedPaymentsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $completedPaymentId): int
    {
        $sql = "DELETE FROM `completed_payments` WHERE `completed_payment_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$completedPaymentId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}