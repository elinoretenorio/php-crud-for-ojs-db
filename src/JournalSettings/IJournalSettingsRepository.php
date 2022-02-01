<?php

declare(strict_types=1);

namespace OJS\JournalSettings;

interface IJournalSettingsRepository
{
    public function insert(JournalSettingsDto $dto): int;

    public function update(JournalSettingsDto $dto): int;

    public function get(int $journalSettingId): ?JournalSettingsDto;

    public function getAll(): array;

    public function delete(int $journalSettingId): int;
}