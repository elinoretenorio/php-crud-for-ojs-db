<?php

declare(strict_types=1);

namespace OJS\Subscriptions;

interface ISubscriptionsService
{
    public function insert(SubscriptionsModel $model): int;

    public function update(SubscriptionsModel $model): int;

    public function get(int $subscriptionId): ?SubscriptionsModel;

    public function getAll(): array;

    public function delete(int $subscriptionId): int;

    public function createModel(array $row): ?SubscriptionsModel;
}