<?php

declare(strict_types=1);

namespace OJS\InstitutionalSubscriptions;

class InstitutionalSubscriptionsService implements IInstitutionalSubscriptionsService
{
    private IInstitutionalSubscriptionsRepository $repository;

    public function __construct(IInstitutionalSubscriptionsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(InstitutionalSubscriptionsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(InstitutionalSubscriptionsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $institutionalSubscriptionId): ?InstitutionalSubscriptionsModel
    {
        $dto = $this->repository->get($institutionalSubscriptionId);
        if ($dto === null) {
            return null;
        }

        return new InstitutionalSubscriptionsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /** @var InstitutionalSubscriptionsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new InstitutionalSubscriptionsModel($dto);
        }

        return $result;
    }

    public function delete(int $institutionalSubscriptionId): int
    {
        return $this->repository->delete($institutionalSubscriptionId);
    }

    public function createModel(array $row): ?InstitutionalSubscriptionsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new InstitutionalSubscriptionsDto($row);

        return new InstitutionalSubscriptionsModel($dto);
    }
}