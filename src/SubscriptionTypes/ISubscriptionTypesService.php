<?php

declare(strict_types=1);

namespace OJS\SubscriptionTypes;

interface ISubscriptionTypesService
{
    public function insert(SubscriptionTypesModel $model): int;

    public function update(SubscriptionTypesModel $model): int;

    public function get(int $typeId): ?SubscriptionTypesModel;

    public function getAll(): array;

    public function delete(int $typeId): int;

    public function createModel(array $row): ?SubscriptionTypesModel;
}