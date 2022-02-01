<?php

declare(strict_types=1);

namespace OJS\IssueSettings;

interface IIssueSettingsService
{
    public function insert(IssueSettingsModel $model): int;

    public function update(IssueSettingsModel $model): int;

    public function get(int $issueSettingId): ?IssueSettingsModel;

    public function getAll(): array;

    public function delete(int $issueSettingId): int;

    public function createModel(array $row): ?IssueSettingsModel;
}