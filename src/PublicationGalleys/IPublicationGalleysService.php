<?php

declare(strict_types=1);

namespace OJS\PublicationGalleys;

interface IPublicationGalleysService
{
    public function insert(PublicationGalleysModel $model): int;

    public function update(PublicationGalleysModel $model): int;

    public function get(int $galleyId): ?PublicationGalleysModel;

    public function getAll(): array;

    public function delete(int $galleyId): int;

    public function createModel(array $row): ?PublicationGalleysModel;
}