<?php

declare(strict_types=1);

namespace OJS\InstitutionalSubscriptions;

interface IInstitutionalSubscriptionsService
{
    public function insert(InstitutionalSubscriptionsModel $model): int;

    public function update(InstitutionalSubscriptionsModel $model): int;

    public function get(int $institutionalSubscriptionId): ?InstitutionalSubscriptionsModel;

    public function getAll(): array;

    public function delete(int $institutionalSubscriptionId): int;

    public function createModel(array $row): ?InstitutionalSubscriptionsModel;
}