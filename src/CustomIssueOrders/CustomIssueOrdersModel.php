<?php

declare(strict_types=1);

namespace OJS\CustomIssueOrders;

use JsonSerializable;

class CustomIssueOrdersModel implements JsonSerializable
{
    private int $customIssueOrderId;
    private int $issueId;
    private int $journalId;
    private float $seq;

    public function __construct(CustomIssueOrdersDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->customIssueOrderId = $dto->customIssueOrderId;
        $this->issueId = $dto->issueId;
        $this->journalId = $dto->journalId;
        $this->seq = $dto->seq;
    }

    public function getCustomIssueOrderId(): int
    {
        return $this->customIssueOrderId;
    }

    public function setCustomIssueOrderId(int $customIssueOrderId): void
    {
        $this->customIssueOrderId = $customIssueOrderId;
    }

    public function getIssueId(): int
    {
        return $this->issueId;
    }

    public function setIssueId(int $issueId): void
    {
        $this->issueId = $issueId;
    }

    public function getJournalId(): int
    {
        return $this->journalId;
    }

    public function setJournalId(int $journalId): void
    {
        $this->journalId = $journalId;
    }

    public function getSeq(): float
    {
        return $this->seq;
    }

    public function setSeq(float $seq): void
    {
        $this->seq = $seq;
    }

    public function toDto(): CustomIssueOrdersDto
    {
        $dto = new CustomIssueOrdersDto();
        $dto->customIssueOrderId = (int) ($this->customIssueOrderId ?? 0);
        $dto->issueId = (int) ($this->issueId ?? 0);
        $dto->journalId = (int) ($this->journalId ?? 0);
        $dto->seq = (float) ($this->seq ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "custom_issue_order_id" => $this->customIssueOrderId,
            "issue_id" => $this->issueId,
            "journal_id" => $this->journalId,
            "seq" => $this->seq,
        ];
    }
}