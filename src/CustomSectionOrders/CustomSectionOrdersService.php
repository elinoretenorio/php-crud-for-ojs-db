<?php

declare(strict_types=1);

namespace OJS\CustomSectionOrders;

class CustomSectionOrdersService implements ICustomSectionOrdersService
{
    private ICustomSectionOrdersRepository $repository;

    public function __construct(ICustomSectionOrdersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(CustomSectionOrdersModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(CustomSectionOrdersModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $customSectionOrderId): ?CustomSectionOrdersModel
    {
        $dto = $this->repository->get($customSectionOrderId);
        if ($dto === null) {
            return null;
        }

        return new CustomSectionOrdersModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /** @var CustomSectionOrdersDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new CustomSectionOrdersModel($dto);
        }

        return $result;
    }

    public function delete(int $customSectionOrderId): int
    {
        return $this->repository->delete($customSectionOrderId);
    }

    public function createModel(array $row): ?CustomSectionOrdersModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new CustomSectionOrdersDto($row);

        return new CustomSectionOrdersModel($dto);
    }
}