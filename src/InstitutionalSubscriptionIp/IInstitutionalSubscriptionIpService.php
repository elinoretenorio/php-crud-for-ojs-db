<?php

declare(strict_types=1);

namespace OJS\InstitutionalSubscriptionIp;

interface IInstitutionalSubscriptionIpService
{
    public function insert(InstitutionalSubscriptionIpModel $model): int;

    public function update(InstitutionalSubscriptionIpModel $model): int;

    public function get(int $institutionalSubscriptionIpId): ?InstitutionalSubscriptionIpModel;

    public function getAll(): array;

    public function delete(int $institutionalSubscriptionIpId): int;

    public function createModel(array $row): ?InstitutionalSubscriptionIpModel;
}