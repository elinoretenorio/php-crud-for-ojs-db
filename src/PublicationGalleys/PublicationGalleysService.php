<?php

declare(strict_types=1);

namespace OJS\PublicationGalleys;

class PublicationGalleysService implements IPublicationGalleysService
{
    private IPublicationGalleysRepository $repository;

    public function __construct(IPublicationGalleysRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(PublicationGalleysModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(PublicationGalleysModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $galleyId): ?PublicationGalleysModel
    {
        $dto = $this->repository->get($galleyId);
        if ($dto === null) {
            return null;
        }

        return new PublicationGalleysModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /** @var PublicationGalleysDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new PublicationGalleysModel($dto);
        }

        return $result;
    }

    public function delete(int $galleyId): int
    {
        return $this->repository->delete($galleyId);
    }

    public function createModel(array $row): ?PublicationGalleysModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new PublicationGalleysDto($row);

        return new PublicationGalleysModel($dto);
    }
}