<?php

declare(strict_types=1);

namespace OJS\CompletedPayments;

use JsonSerializable;

class CompletedPaymentsModel implements JsonSerializable
{
    private int $completedPaymentId;
    private string $timestamp;
    private int $paymentType;
    private int $contextId;
    private ?int $userId;
    private ?int $assocId;
    private float $amount;
    private ?string $currencyCodeAlpha;
    private ?string $paymentMethodPluginName;

    public function __construct(CompletedPaymentsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->completedPaymentId = $dto->completedPaymentId;
        $this->timestamp = $dto->timestamp;
        $this->paymentType = $dto->paymentType;
        $this->contextId = $dto->contextId;
        $this->userId = $dto->userId;
        $this->assocId = $dto->assocId;
        $this->amount = $dto->amount;
        $this->currencyCodeAlpha = $dto->currencyCodeAlpha;
        $this->paymentMethodPluginName = $dto->paymentMethodPluginName;
    }

    public function getCompletedPaymentId(): int
    {
        return $this->completedPaymentId;
    }

    public function setCompletedPaymentId(int $completedPaymentId): void
    {
        $this->completedPaymentId = $completedPaymentId;
    }

    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    public function setTimestamp(string $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    public function getPaymentType(): int
    {
        return $this->paymentType;
    }

    public function setPaymentType(int $paymentType): void
    {
        $this->paymentType = $paymentType;
    }

    public function getContextId(): int
    {
        return $this->contextId;
    }

    public function setContextId(int $contextId): void
    {
        $this->contextId = $contextId;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
    }

    public function getAssocId(): ?int
    {
        return $this->assocId;
    }

    public function setAssocId(?int $assocId): void
    {
        $this->assocId = $assocId;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function getCurrencyCodeAlpha(): ?string
    {
        return $this->currencyCodeAlpha;
    }

    public function setCurrencyCodeAlpha(?string $currencyCodeAlpha): void
    {
        $this->currencyCodeAlpha = $currencyCodeAlpha;
    }

    public function getPaymentMethodPluginName(): ?string
    {
        return $this->paymentMethodPluginName;
    }

    public function setPaymentMethodPluginName(?string $paymentMethodPluginName): void
    {
        $this->paymentMethodPluginName = $paymentMethodPluginName;
    }

    public function toDto(): CompletedPaymentsDto
    {
        $dto = new CompletedPaymentsDto();
        $dto->completedPaymentId = (int) ($this->completedPaymentId ?? 0);
        $dto->timestamp = (string) ($this->timestamp ?? "");
        $dto->paymentType = (int) ($this->paymentType ?? 0);
        $dto->contextId = (int) ($this->contextId ?? 0);
        $dto->userId = isset($this->userId) ? (int) $this->userId : null;
        $dto->assocId = isset($this->assocId) ? (int) $this->assocId : null;
        $dto->amount = (float) ($this->amount ?? 0);
        $dto->currencyCodeAlpha = isset($this->currencyCodeAlpha) ? (string) $this->currencyCodeAlpha : null;
        $dto->paymentMethodPluginName = isset($this->paymentMethodPluginName) ? (string) $this->paymentMethodPluginName : null;

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "completed_payment_id" => $this->completedPaymentId,
            "timestamp" => $this->timestamp,
            "payment_type" => $this->paymentType,
            "context_id" => $this->contextId,
            "user_id" => $this->userId,
            "assoc_id" => $this->assocId,
            "amount" => $this->amount,
            "currency_code_alpha" => $this->currencyCodeAlpha,
            "payment_method_plugin_name" => $this->paymentMethodPluginName,
        ];
    }
}