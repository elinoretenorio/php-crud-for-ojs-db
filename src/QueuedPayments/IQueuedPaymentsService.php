<?php

declare(strict_types=1);

namespace OJS\QueuedPayments;

interface IQueuedPaymentsService
{
    public function insert(QueuedPaymentsModel $model): int;

    public function update(QueuedPaymentsModel $model): int;

    public function get(int $queuedPaymentId): ?QueuedPaymentsModel;

    public function getAll(): array;

    public function delete(int $queuedPaymentId): int;

    public function createModel(array $row): ?QueuedPaymentsModel;
}