<?php

declare(strict_types=1);

namespace OJS\Publications;

class PublicationsService implements IPublicationsService
{
    private IPublicationsRepository $repository;

    public function __construct(IPublicationsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(PublicationsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(PublicationsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $publicationId): ?PublicationsModel
    {
        $dto = $this->repository->get($publicationId);
        if ($dto === null) {
            return null;
        }

        return new PublicationsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /** @var PublicationsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new PublicationsModel($dto);
        }

        return $result;
    }

    public function delete(int $publicationId): int
    {
        return $this->repository->delete($publicationId);
    }

    public function createModel(array $row): ?PublicationsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new PublicationsDto($row);

        return new PublicationsModel($dto);
    }
}