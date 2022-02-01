<?php

declare(strict_types=1);

namespace OJS\IssueGalleySettings;

class IssueGalleySettingsService implements IIssueGalleySettingsService
{
    private IIssueGalleySettingsRepository $repository;

    public function __construct(IIssueGalleySettingsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(IssueGalleySettingsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(IssueGalleySettingsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $galleyId): ?IssueGalleySettingsModel
    {
        $dto = $this->repository->get($galleyId);
        if ($dto === null) {
            return null;
        }

        return new IssueGalleySettingsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /** @var IssueGalleySettingsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new IssueGalleySettingsModel($dto);
        }

        return $result;
    }

    public function delete(int $galleyId): int
    {
        return $this->repository->delete($galleyId);
    }

    public function createModel(array $row): ?IssueGalleySettingsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new IssueGalleySettingsDto($row);

        return new IssueGalleySettingsModel($dto);
    }
}