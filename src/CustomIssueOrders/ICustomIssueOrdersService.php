<?php

declare(strict_types=1);

namespace OJS\CustomIssueOrders;

interface ICustomIssueOrdersService
{
    public function insert(CustomIssueOrdersModel $model): int;

    public function update(CustomIssueOrdersModel $model): int;

    public function get(int $customIssueOrderId): ?CustomIssueOrdersModel;

    public function getAll(): array;

    public function delete(int $customIssueOrderId): int;

    public function createModel(array $row): ?CustomIssueOrdersModel;
}