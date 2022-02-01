<?php

declare(strict_types=1);

namespace OJS\Subscriptions;

use JsonSerializable;

class SubscriptionsModel implements JsonSerializable
{
    private int $subscriptionId;
    private int $journalId;
    private int $userId;
    private int $typeId;
    private ?string $dateStart;
    private ?string $dateEnd;
    private int $status;
    private ?string $membership;
    private ?string $referenceNumber;
    private ?string $notes;

    public function __construct(SubscriptionsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->subscriptionId = $dto->subscriptionId;
        $this->journalId = $dto->journalId;
        $this->userId = $dto->userId;
        $this->typeId = $dto->typeId;
        $this->dateStart = $dto->dateStart;
        $this->dateEnd = $dto->dateEnd;
        $this->status = $dto->status;
        $this->membership = $dto->membership;
        $this->referenceNumber = $dto->referenceNumber;
        $this->notes = $dto->notes;
    }

    public function getSubscriptionId(): int
    {
        return $this->subscriptionId;
    }

    public function setSubscriptionId(int $subscriptionId): void
    {
        $this->subscriptionId = $subscriptionId;
    }

    public function getJournalId(): int
    {
        return $this->journalId;
    }

    public function setJournalId(int $journalId): void
    {
        $this->journalId = $journalId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    public function setTypeId(int $typeId): void
    {
        $this->typeId = $typeId;
    }

    public function getDateStart(): ?string
    {
        return $this->dateStart;
    }

    public function setDateStart(?string $dateStart): void
    {
        $this->dateStart = $dateStart;
    }

    public function getDateEnd(): ?string
    {
        return $this->dateEnd;
    }

    public function setDateEnd(?string $dateEnd): void
    {
        $this->dateEnd = $dateEnd;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getMembership(): ?string
    {
        return $this->membership;
    }

    public function setMembership(?string $membership): void
    {
        $this->membership = $membership;
    }

    public function getReferenceNumber(): ?string
    {
        return $this->referenceNumber;
    }

    public function setReferenceNumber(?string $referenceNumber): void
    {
        $this->referenceNumber = $referenceNumber;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): void
    {
        $this->notes = $notes;
    }

    public function toDto(): SubscriptionsDto
    {
        $dto = new SubscriptionsDto();
        $dto->subscriptionId = (int) ($this->subscriptionId ?? 0);
        $dto->journalId = (int) ($this->journalId ?? 0);
        $dto->userId = (int) ($this->userId ?? 0);
        $dto->typeId = (int) ($this->typeId ?? 0);
        $dto->dateStart = isset($this->dateStart) ? (string) $this->dateStart : null;
        $dto->dateEnd = isset($this->dateEnd) ? (string) $this->dateEnd : null;
        $dto->status = (int) ($this->status ?? 1);
        $dto->membership = isset($this->membership) ? (string) $this->membership : null;
        $dto->referenceNumber = isset($this->referenceNumber) ? (string) $this->referenceNumber : null;
        $dto->notes = isset($this->notes) ? (string) $this->notes : null;

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "subscription_id" => $this->subscriptionId,
            "journal_id" => $this->journalId,
            "user_id" => $this->userId,
            "type_id" => $this->typeId,
            "date_start" => $this->dateStart,
            "date_end" => $this->dateEnd,
            "status" => $this->status,
            "membership" => $this->membership,
            "reference_number" => $this->referenceNumber,
            "notes" => $this->notes,
        ];
    }
}