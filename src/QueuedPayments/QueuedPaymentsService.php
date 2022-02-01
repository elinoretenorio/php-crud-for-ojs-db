<?php

declare(strict_types=1);

namespace OJS\QueuedPayments;

class QueuedPaymentsService implements IQueuedPaymentsService
{
    private IQueuedPaymentsRepository $repository;

    public function __construct(IQueuedPaymentsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(QueuedPaymentsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(QueuedPaymentsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $queuedPaymentId): ?QueuedPaymentsModel
    {
        $dto = $this->repository->get($queuedPaymentId);
        if ($dto === null) {
            return null;
        }

        return new QueuedPaymentsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /** @var QueuedPaymentsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new QueuedPaymentsModel($dto);
        }

        return $result;
    }

    public function delete(int $queuedPaymentId): int
    {
        return $this->repository->delete($queuedPaymentId);
    }

    public function createModel(array $row): ?QueuedPaymentsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new QueuedPaymentsDto($row);

        return new QueuedPaymentsModel($dto);
    }
}