<?php

declare(strict_types=1);

namespace OJS\Issues;

class IssuesService implements IIssuesService
{
    private IIssuesRepository $repository;

    public function __construct(IIssuesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(IssuesModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(IssuesModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $issueId): ?IssuesModel
    {
        $dto = $this->repository->get($issueId);
        if ($dto === null) {
            return null;
        }

        return new IssuesModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /** @var IssuesDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new IssuesModel($dto);
        }

        return $result;
    }

    public function delete(int $issueId): int
    {
        return $this->repository->delete($issueId);
    }

    public function createModel(array $row): ?IssuesModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new IssuesDto($row);

        return new IssuesModel($dto);
    }
}