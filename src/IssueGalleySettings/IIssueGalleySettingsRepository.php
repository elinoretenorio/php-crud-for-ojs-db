<?php

declare(strict_types=1);

namespace OJS\IssueGalleySettings;

interface IIssueGalleySettingsRepository
{
    public function insert(IssueGalleySettingsDto $dto): int;

    public function update(IssueGalleySettingsDto $dto): int;

    public function get(int $galleyId): ?IssueGalleySettingsDto;

    public function getAll(): array;

    public function delete(int $galleyId): int;
}