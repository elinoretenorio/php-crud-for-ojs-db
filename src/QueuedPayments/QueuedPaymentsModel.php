<?php

declare(strict_types=1);

namespace OJS\QueuedPayments;

use JsonSerializable;

class QueuedPaymentsModel implements JsonSerializable
{
    private int $queuedPaymentId;
    private string $dateCreated;
    private string $dateModified;
    private ?string $expiryDate;
    private ?string $paymentData;

    public function __construct(QueuedPaymentsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->queuedPaymentId = $dto->queuedPaymentId;
        $this->dateCreated = $dto->dateCreated;
        $this->dateModified = $dto->dateModified;
        $this->expiryDate = $dto->expiryDate;
        $this->paymentData = $dto->paymentData;
    }

    public function getQueuedPaymentId(): int
    {
        return $this->queuedPaymentId;
    }

    public function setQueuedPaymentId(int $queuedPaymentId): void
    {
        $this->queuedPaymentId = $queuedPaymentId;
    }

    public function getDateCreated(): string
    {
        return $this->dateCreated;
    }

    public function setDateCreated(string $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    public function getDateModified(): string
    {
        return $this->dateModified;
    }

    public function setDateModified(string $dateModified): void
    {
        $this->dateModified = $dateModified;
    }

    public function getExpiryDate(): ?string
    {
        return $this->expiryDate;
    }

    public function setExpiryDate(?string $expiryDate): void
    {
        $this->expiryDate = $expiryDate;
    }

    public function getPaymentData(): ?string
    {
        return $this->paymentData;
    }

    public function setPaymentData(?string $paymentData): void
    {
        $this->paymentData = $paymentData;
    }

    public function toDto(): QueuedPaymentsDto
    {
        $dto = new QueuedPaymentsDto();
        $dto->queuedPaymentId = (int) ($this->queuedPaymentId ?? 0);
        $dto->dateCreated = (string) ($this->dateCreated ?? "");
        $dto->dateModified = (string) ($this->dateModified ?? "");
        $dto->expiryDate = isset($this->expiryDate) ? (string) $this->expiryDate : null;
        $dto->paymentData = isset($this->paymentData) ? (string) $this->paymentData : null;

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "queued_payment_id" => $this->queuedPaymentId,
            "date_created" => $this->dateCreated,
            "date_modified" => $this->dateModified,
            "expiry_date" => $this->expiryDate,
            "payment_data" => $this->paymentData,
        ];
    }
}