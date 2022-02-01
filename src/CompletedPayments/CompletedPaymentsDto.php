<?php

declare(strict_types=1);

namespace OJS\CompletedPayments;

class CompletedPaymentsDto 
{
    public int $completedPaymentId;
    public string $timestamp;
    public int $paymentType;
    public int $contextId;
    public ?int $userId;
    public ?int $assocId;
    public float $amount;
    public ?string $currencyCodeAlpha;
    public ?string $paymentMethodPluginName;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->completedPaymentId = (int) ($row["completed_payment_id"] ?? 0);
        $this->timestamp = (string) ($row["timestamp"] ?? "");
        $this->paymentType = (int) ($row["payment_type"] ?? 0);
        $this->contextId = (int) ($row["context_id"] ?? 0);
        $this->userId = isset($row["user_id"]) ? (int) $row["user_id"] : null;
        $this->assocId = isset($row["assoc_id"]) ? (int) $row["assoc_id"] : null;
        $this->amount = (float) ($row["amount"] ?? 0);
        $this->currencyCodeAlpha = isset($row["currency_code_alpha"]) ? (string) $row["currency_code_alpha"] : null;
        $this->paymentMethodPluginName = isset($row["payment_method_plugin_name"]) ? (string) $row["payment_method_plugin_name"] : null;
    }
}