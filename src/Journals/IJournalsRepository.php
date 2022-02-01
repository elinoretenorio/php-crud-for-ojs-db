<?php

declare(strict_types=1);

namespace OJS\Journals;

interface IJournalsRepository
{
    public function insert(JournalsDto $dto): int;

    public function update(JournalsDto $dto): int;

    public function get(int $journalId): ?JournalsDto;

    public function getAll(): array;

    public function delete(int $journalId): int;
}