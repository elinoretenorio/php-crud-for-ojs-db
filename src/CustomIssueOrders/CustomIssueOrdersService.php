<?php

declare(strict_types=1);

namespace OJS\CustomIssueOrders;

class CustomIssueOrdersService implements ICustomIssueOrdersService
{
    private ICustomIssueOrdersRepository $repository;

    public function __construct(ICustomIssueOrdersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(CustomIssueOrdersModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(CustomIssueOrdersModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $customIssueOrderId): ?CustomIssueOrdersModel
    {
        $dto = $this->repository->get($customIssueOrderId);
        if ($dto === null) {
            return null;
        }

        return new CustomIssueOrdersModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /** @var CustomIssueOrdersDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new CustomIssueOrdersModel($dto);
        }

        return $result;
    }

    public function delete(int $customIssueOrderId): int
    {
        return $this->repository->delete($customIssueOrderId);
    }

    public function createModel(array $row): ?CustomIssueOrdersModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new CustomIssueOrdersDto($row);

        return new CustomIssueOrdersModel($dto);
    }
}