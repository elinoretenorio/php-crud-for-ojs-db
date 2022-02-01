<?php

declare(strict_types=1);

namespace OJS\SubscriptionTypes;

class SubscriptionTypesDto 
{
    public int $typeId;
    public int $journalId;
    public float $cost;
    public string $currencyCodeAlpha;
    public ?int $duration;
    public int $format;
    public int $institutional;
    public int $membership;
    public int $disablePublicDisplay;
    public float $seq;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->typeId = (int) ($row["type_id"] ?? 0);
        $this->journalId = (int) ($row["journal_id"] ?? 0);
        $this->cost = (float) ($row["cost"] ?? 0);
        $this->currencyCodeAlpha = (string) ($row["currency_code_alpha"] ?? "");
        $this->duration = isset($row["duration"]) ? (int) $row["duration"] : null;
        $this->format = (int) ($row["format"] ?? 0);
        $this->institutional = (int) ($row["institutional"] ?? 0);
        $this->membership = (int) ($row["membership"] ?? 0);
        $this->disablePublicDisplay = (int) ($row["disable_public_display"] ?? 0);
        $this->seq = (float) ($row["seq"] ?? 0);
    }
}