<?php

declare(strict_types=1);

namespace OJS\IssueGalleys;

interface IIssueGalleysRepository
{
    public function insert(IssueGalleysDto $dto): int;

    public function update(IssueGalleysDto $dto): int;

    public function get(int $galleyId): ?IssueGalleysDto;

    public function getAll(): array;

    public function delete(int $galleyId): int;
}