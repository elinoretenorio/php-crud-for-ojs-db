<?php

declare(strict_types=1);

namespace OJS\IssueGalleySettings;

interface IIssueGalleySettingsService
{
    public function insert(IssueGalleySettingsModel $model): int;

    public function update(IssueGalleySettingsModel $model): int;

    public function get(int $galleyId): ?IssueGalleySettingsModel;

    public function getAll(): array;

    public function delete(int $galleyId): int;

    public function createModel(array $row): ?IssueGalleySettingsModel;
}