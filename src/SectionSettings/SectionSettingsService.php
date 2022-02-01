<?php

declare(strict_types=1);

namespace OJS\SectionSettings;

class SectionSettingsService implements ISectionSettingsService
{
    private ISectionSettingsRepository $repository;

    public function __construct(ISectionSettingsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(SectionSettingsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(SectionSettingsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $sectionSettingId): ?SectionSettingsModel
    {
        $dto = $this->repository->get($sectionSettingId);
        if ($dto === null) {
            return null;
        }

        return new SectionSettingsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /** @var SectionSettingsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new SectionSettingsModel($dto);
        }

        return $result;
    }

    public function delete(int $sectionSettingId): int
    {
        return $this->repository->delete($sectionSettingId);
    }

    public function createModel(array $row): ?SectionSettingsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new SectionSettingsDto($row);

        return new SectionSettingsModel($dto);
    }
}