<?php

declare(strict_types=1);

namespace OJS\QueuedPayments;

class QueuedPaymentsDto 
{
    public int $queuedPaymentId;
    public string $dateCreated;
    public string $dateModified;
    public ?string $expiryDate;
    public ?string $paymentData;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->queuedPaymentId = (int) ($row["queued_payment_id"] ?? 0);
        $this->dateCreated = (string) ($row["date_created"] ?? "");
        $this->dateModified = (string) ($row["date_modified"] ?? "");
        $this->expiryDate = isset($row["expiry_date"]) ? (string) $row["expiry_date"] : null;
        $this->paymentData = isset($row["payment_data"]) ? (string) $row["payment_data"] : null;
    }
}