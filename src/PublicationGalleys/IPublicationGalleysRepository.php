<?php

declare(strict_types=1);

namespace OJS\PublicationGalleys;

interface IPublicationGalleysRepository
{
    public function insert(PublicationGalleysDto $dto): int;

    public function update(PublicationGalleysDto $dto): int;

    public function get(int $galleyId): ?PublicationGalleysDto;

    public function getAll(): array;

    public function delete(int $galleyId): int;
}