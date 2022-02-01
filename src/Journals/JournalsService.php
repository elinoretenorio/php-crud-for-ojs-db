<?php

declare(strict_types=1);

namespace OJS\Journals;

class JournalsService implements IJournalsService
{
    private IJournalsRepository $repository;

    public function __construct(IJournalsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(JournalsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(JournalsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $journalId): ?JournalsModel
    {
        $dto = $this->repository->get($journalId);
        if ($dto === null) {
            return null;
        }

        return new JournalsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /** @var JournalsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new JournalsModel($dto);
        }

        return $result;
    }

    public function delete(int $journalId): int
    {
        return $this->repository->delete($journalId);
    }

    public function createModel(array $row): ?JournalsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new JournalsDto($row);

        return new JournalsModel($dto);
    }
}