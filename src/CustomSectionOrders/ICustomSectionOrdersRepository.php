<?php

declare(strict_types=1);

namespace OJS\CustomSectionOrders;

interface ICustomSectionOrdersRepository
{
    public function insert(CustomSectionOrdersDto $dto): int;

    public function update(CustomSectionOrdersDto $dto): int;

    public function get(int $customSectionOrderId): ?CustomSectionOrdersDto;

    public function getAll(): array;

    public function delete(int $customSectionOrderId): int;
}