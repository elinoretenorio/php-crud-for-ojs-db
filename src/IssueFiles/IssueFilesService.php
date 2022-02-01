<?php

declare(strict_types=1);

namespace OJS\IssueFiles;

class IssueFilesService implements IIssueFilesService
{
    private IIssueFilesRepository $repository;

    public function __construct(IIssueFilesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(IssueFilesModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(IssueFilesModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $fileId): ?IssueFilesModel
    {
        $dto = $this->repository->get($fileId);
        if ($dto === null) {
            return null;
        }

        return new IssueFilesModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /** @var IssueFilesDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new IssueFilesModel($dto);
        }

        return $result;
    }

    public function delete(int $fileId): int
    {
        return $this->repository->delete($fileId);
    }

    public function createModel(array $row): ?IssueFilesModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new IssueFilesDto($row);

        return new IssueFilesModel($dto);
    }
}