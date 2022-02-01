<?php

declare(strict_types=1);

namespace OJS\SectionSettings;

interface ISectionSettingsRepository
{
    public function insert(SectionSettingsDto $dto): int;

    public function update(SectionSettingsDto $dto): int;

    public function get(int $sectionSettingId): ?SectionSettingsDto;

    public function getAll(): array;

    public function delete(int $sectionSettingId): int;
}