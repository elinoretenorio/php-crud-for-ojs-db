<?php

declare(strict_types=1);

namespace OJS\CompletedPayments;

class CompletedPaymentsService implements ICompletedPaymentsService
{
    private ICompletedPaymentsRepository $repository;

    public function __construct(ICompletedPaymentsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(CompletedPaymentsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(CompletedPaymentsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $completedPaymentId): ?CompletedPaymentsModel
    {
        $dto = $this->repository->get($completedPaymentId);
        if ($dto === null) {
            return null;
        }

        return new CompletedPaymentsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /** @var CompletedPaymentsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new CompletedPaymentsModel($dto);
        }

        return $result;
    }

    public function delete(int $completedPaymentId): int
    {
        return $this->repository->delete($completedPaymentId);
    }

    public function createModel(array $row): ?CompletedPaymentsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new CompletedPaymentsDto($row);

        return new CompletedPaymentsModel($dto);
    }
}