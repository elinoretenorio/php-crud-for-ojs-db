<?php

declare(strict_types=1);

namespace OJS\CustomSectionOrders;

interface ICustomSectionOrdersService
{
    public function insert(CustomSectionOrdersModel $model): int;

    public function update(CustomSectionOrdersModel $model): int;

    public function get(int $customSectionOrderId): ?CustomSectionOrdersModel;

    public function getAll(): array;

    public function delete(int $customSectionOrderId): int;

    public function createModel(array $row): ?CustomSectionOrdersModel;
}