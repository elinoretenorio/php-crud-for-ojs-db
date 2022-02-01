<?php

declare(strict_types=1);

namespace OJS\PublicationGalleySettings;

interface IPublicationGalleySettingsService
{
    public function insert(PublicationGalleySettingsModel $model): int;

    public function update(PublicationGalleySettingsModel $model): int;

    public function get(int $publicationGalleySettingId): ?PublicationGalleySettingsModel;

    public function getAll(): array;

    public function delete(int $publicationGalleySettingId): int;

    public function createModel(array $row): ?PublicationGalleySettingsModel;
}