<?php

declare(strict_types=1);

namespace OJS\SubscriptionTypes;

use JsonSerializable;

class SubscriptionTypesModel implements JsonSerializable
{
    private int $typeId;
    private int $journalId;
    private float $cost;
    private string $currencyCodeAlpha;
    private ?int $duration;
    private int $format;
    private int $institutional;
    private int $membership;
    private int $disablePublicDisplay;
    private float $seq;

    public function __construct(SubscriptionTypesDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->typeId = $dto->typeId;
        $this->journalId = $dto->journalId;
        $this->cost = $dto->cost;
        $this->currencyCodeAlpha = $dto->currencyCodeAlpha;
        $this->duration = $dto->duration;
        $this->format = $dto->format;
        $this->institutional = $dto->institutional;
        $this->membership = $dto->membership;
        $this->disablePublicDisplay = $dto->disablePublicDisplay;
        $this->seq = $dto->seq;
    }

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    public function setTypeId(int $typeId): void
    {
        $this->typeId = $typeId;
    }

    public function getJournalId(): int
    {
        return $this->journalId;
    }

    public function setJournalId(int $journalId): void
    {
        $this->journalId = $journalId;
    }

    public function getCost(): float
    {
        return $this->cost;
    }

    public function setCost(float $cost): void
    {
        $this->cost = $cost;
    }

    public function getCurrencyCodeAlpha(): string
    {
        return $this->currencyCodeAlpha;
    }

    public function setCurrencyCodeAlpha(string $currencyCodeAlpha): void
    {
        $this->currencyCodeAlpha = $currencyCodeAlpha;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): void
    {
        $this->duration = $duration;
    }

    public function getFormat(): int
    {
        return $this->format;
    }

    public function setFormat(int $format): void
    {
        $this->format = $format;
    }

    public function getInstitutional(): int
    {
        return $this->institutional;
    }

    public function setInstitutional(int $institutional): void
    {
        $this->institutional = $institutional;
    }

    public function getMembership(): int
    {
        return $this->membership;
    }

    public function setMembership(int $membership): void
    {
        $this->membership = $membership;
    }

    public function getDisablePublicDisplay(): int
    {
        return $this->disablePublicDisplay;
    }

    public function setDisablePublicDisplay(int $disablePublicDisplay): void
    {
        $this->disablePublicDisplay = $disablePublicDisplay;
    }

    public function getSeq(): float
    {
        return $this->seq;
    }

    public function setSeq(float $seq): void
    {
        $this->seq = $seq;
    }

    public function toDto(): SubscriptionTypesDto
    {
        $dto = new SubscriptionTypesDto();
        $dto->typeId = (int) ($this->typeId ?? 0);
        $dto->journalId = (int) ($this->journalId ?? 0);
        $dto->cost = (float) ($this->cost ?? 0);
        $dto->currencyCodeAlpha = (string) ($this->currencyCodeAlpha ?? "");
        $dto->duration = isset($this->duration) ? (int) $this->duration : null;
        $dto->format = (int) ($this->format ?? 0);
        $dto->institutional = (int) ($this->institutional ?? 0);
        $dto->membership = (int) ($this->membership ?? 0);
        $dto->disablePublicDisplay = (int) ($this->disablePublicDisplay ?? 0);
        $dto->seq = (float) ($this->seq ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "type_id" => $this->typeId,
            "journal_id" => $this->journalId,
            "cost" => $this->cost,
            "currency_code_alpha" => $this->currencyCodeAlpha,
            "duration" => $this->duration,
            "format" => $this->format,
            "institutional" => $this->institutional,
            "membership" => $this->membership,
            "disable_public_display" => $this->disablePublicDisplay,
            "seq" => $this->seq,
        ];
    }
}