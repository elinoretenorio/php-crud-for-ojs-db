<?php

declare(strict_types=1);

namespace OJS\SubscriptionTypes;

class SubscriptionTypesService implements ISubscriptionTypesService
{
    private ISubscriptionTypesRepository $repository;

    public function __construct(ISubscriptionTypesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(SubscriptionTypesModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(SubscriptionTypesModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $typeId): ?SubscriptionTypesModel
    {
        $dto = $this->repository->get($typeId);
        if ($dto === null) {
            return null;
        }

        return new SubscriptionTypesModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /** @var SubscriptionTypesDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new SubscriptionTypesModel($dto);
        }

        return $result;
    }

    public function delete(int $typeId): int
    {
        return $this->repository->delete($typeId);
    }

    public function createModel(array $row): ?SubscriptionTypesModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new SubscriptionTypesDto($row);

        return new SubscriptionTypesModel($dto);
    }
}