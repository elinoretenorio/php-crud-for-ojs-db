<?php

declare(strict_types=1);

namespace OJS\JournalSettings;

class JournalSettingsService implements IJournalSettingsService
{
    private IJournalSettingsRepository $repository;

    public function __construct(IJournalSettingsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(JournalSettingsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(JournalSettingsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $journalSettingId): ?JournalSettingsModel
    {
        $dto = $this->repository->get($journalSettingId);
        if ($dto === null) {
            return null;
        }

        return new JournalSettingsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /** @var JournalSettingsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new JournalSettingsModel($dto);
        }

        return $result;
    }

    public function delete(int $journalSettingId): int
    {
        return $this->repository->delete($journalSettingId);
    }

    public function createModel(array $row): ?JournalSettingsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new JournalSettingsDto($row);

        return new JournalSettingsModel($dto);
    }
}