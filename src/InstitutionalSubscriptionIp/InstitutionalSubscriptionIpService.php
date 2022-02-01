<?php

declare(strict_types=1);

namespace OJS\InstitutionalSubscriptionIp;

class InstitutionalSubscriptionIpService implements IInstitutionalSubscriptionIpService
{
    private IInstitutionalSubscriptionIpRepository $repository;

    public function __construct(IInstitutionalSubscriptionIpRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(InstitutionalSubscriptionIpModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(InstitutionalSubscriptionIpModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $institutionalSubscriptionIpId): ?InstitutionalSubscriptionIpModel
    {
        $dto = $this->repository->get($institutionalSubscriptionIpId);
        if ($dto === null) {
            return null;
        }

        return new InstitutionalSubscriptionIpModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /** @var InstitutionalSubscriptionIpDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new InstitutionalSubscriptionIpModel($dto);
        }

        return $result;
    }

    public function delete(int $institutionalSubscriptionIpId): int
    {
        return $this->repository->delete($institutionalSubscriptionIpId);
    }

    public function createModel(array $row): ?InstitutionalSubscriptionIpModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new InstitutionalSubscriptionIpDto($row);

        return new InstitutionalSubscriptionIpModel($dto);
    }
}