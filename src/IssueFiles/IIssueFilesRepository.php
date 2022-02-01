<?php

declare(strict_types=1);

namespace OJS\IssueFiles;

interface IIssueFilesRepository
{
    public function insert(IssueFilesDto $dto): int;

    public function update(IssueFilesDto $dto): int;

    public function get(int $fileId): ?IssueFilesDto;

    public function getAll(): array;

    public function delete(int $fileId): int;
}