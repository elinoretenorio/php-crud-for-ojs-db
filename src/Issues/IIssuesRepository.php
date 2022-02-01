<?php

declare(strict_types=1);

namespace OJS\Issues;

interface IIssuesRepository
{
    public function insert(IssuesDto $dto): int;

    public function update(IssuesDto $dto): int;

    public function get(int $issueId): ?IssuesDto;

    public function getAll(): array;

    public function delete(int $issueId): int;
}