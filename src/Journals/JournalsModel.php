<?php

declare(strict_types=1);

namespace OJS\Journals;

use JsonSerializable;

class JournalsModel implements JsonSerializable
{
    private int $journalId;
    private string $path;
    private float $seq;
    private string $primaryLocale;
    private int $enabled;
    private ?int $currentIssueId;

    public function __construct(JournalsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->journalId = $dto->journalId;
        $this->path = $dto->path;
        $this->seq = $dto->seq;
        $this->primaryLocale = $dto->primaryLocale;
        $this->enabled = $dto->enabled;
        $this->currentIssueId = $dto->currentIssueId;
    }

    public function getJournalId(): int
    {
        return $this->journalId;
    }

    public function setJournalId(int $journalId): void
    {
        $this->journalId = $journalId;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getSeq(): float
    {
        return $this->seq;
    }

    public function setSeq(float $seq): void
    {
        $this->seq = $seq;
    }

    public function getPrimaryLocale(): string
    {
        return $this->primaryLocale;
    }

    public function setPrimaryLocale(string $primaryLocale): void
    {
        $this->primaryLocale = $primaryLocale;
    }

    public function getEnabled(): int
    {
        return $this->enabled;
    }

    public function setEnabled(int $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function getCurrentIssueId(): ?int
    {
        return $this->currentIssueId;
    }

    public function setCurrentIssueId(?int $currentIssueId): void
    {
        $this->currentIssueId = $currentIssueId;
    }

    public function toDto(): JournalsDto
    {
        $dto = new JournalsDto();
        $dto->journalId = (int) ($this->journalId ?? 0);
        $dto->path = (string) ($this->path ?? "");
        $dto->seq = (float) ($this->seq ?? 0);
        $dto->primaryLocale = (string) ($this->primaryLocale ?? "");
        $dto->enabled = (int) ($this->enabled ?? 1);
        $dto->currentIssueId = isset($this->currentIssueId) ? (int) $this->currentIssueId : null;

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "journal_id" => $this->journalId,
            "path" => $this->path,
            "seq" => $this->seq,
            "primary_locale" => $this->primaryLocale,
            "enabled" => $this->enabled,
            "current_issue_id" => $this->currentIssueId,
        ];
    }
}