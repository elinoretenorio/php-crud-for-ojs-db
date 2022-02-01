<?php

declare(strict_types=1);

namespace OJS\CustomSectionOrders;

use JsonSerializable;

class CustomSectionOrdersModel implements JsonSerializable
{
    private int $customSectionOrderId;
    private int $issueId;
    private int $sectionId;
    private float $seq;

    public function __construct(CustomSectionOrdersDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->customSectionOrderId = $dto->customSectionOrderId;
        $this->issueId = $dto->issueId;
        $this->sectionId = $dto->sectionId;
        $this->seq = $dto->seq;
    }

    public function getCustomSectionOrderId(): int
    {
        return $this->customSectionOrderId;
    }

    public function setCustomSectionOrderId(int $customSectionOrderId): void
    {
        $this->customSectionOrderId = $customSectionOrderId;
    }

    public function getIssueId(): int
    {
        return $this->issueId;
    }

    public function setIssueId(int $issueId): void
    {
        $this->issueId = $issueId;
    }

    public function getSectionId(): int
    {
        return $this->sectionId;
    }

    public function setSectionId(int $sectionId): void
    {
        $this->sectionId = $sectionId;
    }

    public function getSeq(): float
    {
        return $this->seq;
    }

    public function setSeq(float $seq): void
    {
        $this->seq = $seq;
    }

    public function toDto(): CustomSectionOrdersDto
    {
        $dto = new CustomSectionOrdersDto();
        $dto->customSectionOrderId = (int) ($this->customSectionOrderId ?? 0);
        $dto->issueId = (int) ($this->issueId ?? 0);
        $dto->sectionId = (int) ($this->sectionId ?? 0);
        $dto->seq = (float) ($this->seq ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "custom_section_order_id" => $this->customSectionOrderId,
            "issue_id" => $this->issueId,
            "section_id" => $this->sectionId,
            "seq" => $this->seq,
        ];
    }
}