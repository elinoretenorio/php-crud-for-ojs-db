<?php

declare(strict_types=1);

namespace OJS\PublicationGalleySettings;

interface IPublicationGalleySettingsRepository
{
    public function insert(PublicationGalleySettingsDto $dto): int;

    public function update(PublicationGalleySettingsDto $dto): int;

    public function get(int $publicationGalleySettingId): ?PublicationGalleySettingsDto;

    public function getAll(): array;

    public function delete(int $publicationGalleySettingId): int;
}