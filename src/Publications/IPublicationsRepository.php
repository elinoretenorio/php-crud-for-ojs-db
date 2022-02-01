<?php

declare(strict_types=1);

namespace OJS\Publications;

interface IPublicationsRepository
{
    public function insert(PublicationsDto $dto): int;

    public function update(PublicationsDto $dto): int;

    public function get(int $publicationId): ?PublicationsDto;

    public function getAll(): array;

    public function delete(int $publicationId): int;
}