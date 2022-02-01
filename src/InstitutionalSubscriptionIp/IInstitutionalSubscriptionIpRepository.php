<?php

declare(strict_types=1);

namespace OJS\InstitutionalSubscriptionIp;

interface IInstitutionalSubscriptionIpRepository
{
    public function insert(InstitutionalSubscriptionIpDto $dto): int;

    public function update(InstitutionalSubscriptionIpDto $dto): int;

    public function get(int $institutionalSubscriptionIpId): ?InstitutionalSubscriptionIpDto;

    public function getAll(): array;

    public function delete(int $institutionalSubscriptionIpId): int;
}