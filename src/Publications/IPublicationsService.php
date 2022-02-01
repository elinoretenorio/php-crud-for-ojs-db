<?php

declare(strict_types=1);

namespace OJS\Publications;

interface IPublicationsService
{
    public function insert(PublicationsModel $model): int;

    public function update(PublicationsModel $model): int;

    public function get(int $publicationId): ?PublicationsModel;

    public function getAll(): array;

    public function delete(int $publicationId): int;

    public function createModel(array $row): ?PublicationsModel;
}