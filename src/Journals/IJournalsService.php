<?php

declare(strict_types=1);

namespace OJS\Journals;

interface IJournalsService
{
    public function insert(JournalsModel $model): int;

    public function update(JournalsModel $model): int;

    public function get(int $journalId): ?JournalsModel;

    public function getAll(): array;

    public function delete(int $journalId): int;

    public function createModel(array $row): ?JournalsModel;
}