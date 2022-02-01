<?php

declare(strict_types=1);

namespace OJS\IssueSettings;

class IssueSettingsService implements IIssueSettingsService
{
    private IIssueSettingsRepository $repository;

    public function __construct(IIssueSettingsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(IssueSettingsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(IssueSettingsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $issueSettingId): ?IssueSettingsModel
    {
        $dto = $this->repository->get($issueSettingId);
        if ($dto === null) {
            return null;
        }

        return new IssueSettingsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /** @var IssueSettingsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new IssueSettingsModel($dto);
        }

        return $result;
    }

    public function delete(int $issueSettingId): int
    {
        return $this->repository->delete($issueSettingId);
    }

    public function createModel(array $row): ?IssueSettingsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new IssueSettingsDto($row);

        return new IssueSettingsModel($dto);
    }
}