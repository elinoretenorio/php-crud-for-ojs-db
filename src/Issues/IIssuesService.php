<?php

declare(strict_types=1);

namespace OJS\Issues;

interface IIssuesService
{
    public function insert(IssuesModel $model): int;

    public function update(IssuesModel $model): int;

    public function get(int $issueId): ?IssuesModel;

    public function getAll(): array;

    public function delete(int $issueId): int;

    public function createModel(array $row): ?IssuesModel;
}