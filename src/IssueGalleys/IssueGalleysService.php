<?php

declare(strict_types=1);

namespace OJS\IssueGalleys;

class IssueGalleysService implements IIssueGalleysService
{
    private IIssueGalleysRepository $repository;

    public function __construct(IIssueGalleysRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(IssueGalleysModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(IssueGalleysModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $galleyId): ?IssueGalleysModel
    {
        $dto = $this->repository->get($galleyId);
        if ($dto === null) {
            return null;
        }

        return new IssueGalleysModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /** @var IssueGalleysDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new IssueGalleysModel($dto);
        }

        return $result;
    }

    public function delete(int $galleyId): int
    {
        return $this->repository->delete($galleyId);
    }

    public function createModel(array $row): ?IssueGalleysModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new IssueGalleysDto($row);

        return new IssueGalleysModel($dto);
    }
}