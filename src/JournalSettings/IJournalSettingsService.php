<?php

declare(strict_types=1);

namespace OJS\JournalSettings;

interface IJournalSettingsService
{
    public function insert(JournalSettingsModel $model): int;

    public function update(JournalSettingsModel $model): int;

    public function get(int $journalSettingId): ?JournalSettingsModel;

    public function getAll(): array;

    public function delete(int $journalSettingId): int;

    public function createModel(array $row): ?JournalSettingsModel;
}