<?php

declare(strict_types=1);

namespace OJS\CompletedPayments;

interface ICompletedPaymentsService
{
    public function insert(CompletedPaymentsModel $model): int;

    public function update(CompletedPaymentsModel $model): int;

    public function get(int $completedPaymentId): ?CompletedPaymentsModel;

    public function getAll(): array;

    public function delete(int $completedPaymentId): int;

    public function createModel(array $row): ?CompletedPaymentsModel;
}