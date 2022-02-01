<?php

declare(strict_types=1);

namespace OJS\SubscriptionTypes;

interface ISubscriptionTypesRepository
{
    public function insert(SubscriptionTypesDto $dto): int;

    public function update(SubscriptionTypesDto $dto): int;

    public function get(int $typeId): ?SubscriptionTypesDto;

    public function getAll(): array;

    public function delete(int $typeId): int;
}