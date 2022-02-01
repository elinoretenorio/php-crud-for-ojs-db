<?php

declare(strict_types=1);

namespace OJS\PublicationGalleySettings;

class PublicationGalleySettingsService implements IPublicationGalleySettingsService
{
    private IPublicationGalleySettingsRepository $repository;

    public function __construct(IPublicationGalleySettingsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(PublicationGalleySettingsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(PublicationGalleySettingsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $publicationGalleySettingId): ?PublicationGalleySettingsModel
    {
        $dto = $this->repository->get($publicationGalleySettingId);
        if ($dto === null) {
            return null;
        }

        return new PublicationGalleySettingsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /** @var PublicationGalleySettingsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new PublicationGalleySettingsModel($dto);
        }

        return $result;
    }

    public function delete(int $publicationGalleySettingId): int
    {
        return $this->repository->delete($publicationGalleySettingId);
    }

    public function createModel(array $row): ?PublicationGalleySettingsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new PublicationGalleySettingsDto($row);

        return new PublicationGalleySettingsModel($dto);
    }
}