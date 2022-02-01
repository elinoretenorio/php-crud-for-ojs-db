<?php

declare(strict_types=1);

namespace OJS\InstitutionalSubscriptions;

interface IInstitutionalSubscriptionsRepository
{
    public function insert(InstitutionalSubscriptionsDto $dto): int;

    public function update(InstitutionalSubscriptionsDto $dto): int;

    public function get(int $institutionalSubscriptionId): ?InstitutionalSubscriptionsDto;

    public function getAll(): array;

    public function delete(int $institutionalSubscriptionId): int;
}