<?php

declare(strict_types=1);

namespace OJS\IssueGalleys;

interface IIssueGalleysService
{
    public function insert(IssueGalleysModel $model): int;

    public function update(IssueGalleysModel $model): int;

    public function get(int $galleyId): ?IssueGalleysModel;

    public function getAll(): array;

    public function delete(int $galleyId): int;

    public function createModel(array $row): ?IssueGalleysModel;
}