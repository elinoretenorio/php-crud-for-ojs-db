<?php

declare(strict_types=1);

namespace OJS\Subscriptions;

interface ISubscriptionsRepository
{
    public function insert(SubscriptionsDto $dto): int;

    public function update(SubscriptionsDto $dto): int;

    public function get(int $subscriptionId): ?SubscriptionsDto;

    public function getAll(): array;

    public function delete(int $subscriptionId): int;
}