<?php

declare(strict_types=1);

namespace OJS\IssueSettings;

interface IIssueSettingsRepository
{
    public function insert(IssueSettingsDto $dto): int;

    public function update(IssueSettingsDto $dto): int;

    public function get(int $issueSettingId): ?IssueSettingsDto;

    public function getAll(): array;

    public function delete(int $issueSettingId): int;
}