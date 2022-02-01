<?php

declare(strict_types=1);

namespace OJS\SectionSettings;

interface ISectionSettingsService
{
    public function insert(SectionSettingsModel $model): int;

    public function update(SectionSettingsModel $model): int;

    public function get(int $sectionSettingId): ?SectionSettingsModel;

    public function getAll(): array;

    public function delete(int $sectionSettingId): int;

    public function createModel(array $row): ?SectionSettingsModel;
}