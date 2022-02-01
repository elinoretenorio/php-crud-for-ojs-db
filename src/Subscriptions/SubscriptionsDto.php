<?php

declare(strict_types=1);

namespace OJS\Subscriptions;

class SubscriptionsDto 
{
    public int $subscriptionId;
    public int $journalId;
    public int $userId;
    public int $typeId;
    public ?string $dateStart;
    public ?string $dateEnd;
    public int $status;
    public ?string $membership;
    public ?string $referenceNumber;
    public ?string $notes;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->subscriptionId = (int) ($row["subscription_id"] ?? 0);
        $this->journalId = (int) ($row["journal_id"] ?? 0);
        $this->userId = (int) ($row["user_id"] ?? 0);
        $this->typeId = (int) ($row["type_id"] ?? 0);
        $this->dateStart = isset($row["date_start"]) ? (string) $row["date_start"] : null;
        $this->dateEnd = isset($row["date_end"]) ? (string) $row["date_end"] : null;
        $this->status = (int) ($row["status"] ?? 1);
        $this->membership = isset($row["membership"]) ? (string) $row["membership"] : null;
        $this->referenceNumber = isset($row["reference_number"]) ? (string) $row["reference_number"] : null;
        $this->notes = isset($row["notes"]) ? (string) $row["notes"] : null;
    }
}