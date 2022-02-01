<?php

declare(strict_types=1);

namespace OJS\CompletedPayments;

interface ICompletedPaymentsRepository
{
    public function insert(CompletedPaymentsDto $dto): int;

    public function update(CompletedPaymentsDto $dto): int;

    public function get(int $completedPaymentId): ?CompletedPaymentsDto;

    public function getAll(): array;

    public function delete(int $completedPaymentId): int;
}