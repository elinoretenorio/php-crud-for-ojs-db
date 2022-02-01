<?php

declare(strict_types=1);

namespace OJS\QueuedPayments;

interface IQueuedPaymentsRepository
{
    public function insert(QueuedPaymentsDto $dto): int;

    public function update(QueuedPaymentsDto $dto): int;

    public function get(int $queuedPaymentId): ?QueuedPaymentsDto;

    public function getAll(): array;

    public function delete(int $queuedPaymentId): int;
}