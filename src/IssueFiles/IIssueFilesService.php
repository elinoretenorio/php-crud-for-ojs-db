<?php

declare(strict_types=1);

namespace OJS\IssueFiles;

interface IIssueFilesService
{
    public function insert(IssueFilesModel $model): int;

    public function update(IssueFilesModel $model): int;

    public function get(int $fileId): ?IssueFilesModel;

    public function getAll(): array;

    public function delete(int $fileId): int;

    public function createModel(array $row): ?IssueFilesModel;
}