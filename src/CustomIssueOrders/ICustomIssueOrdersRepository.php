<?php

declare(strict_types=1);

namespace OJS\CustomIssueOrders;

interface ICustomIssueOrdersRepository
{
    public function insert(CustomIssueOrdersDto $dto): int;

    public function update(CustomIssueOrdersDto $dto): int;

    public function get(int $customIssueOrderId): ?CustomIssueOrdersDto;

    public function getAll(): array;

    public function delete(int $customIssueOrderId): int;
}