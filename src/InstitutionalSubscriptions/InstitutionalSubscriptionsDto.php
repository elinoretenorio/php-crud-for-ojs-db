<?php

declare(strict_types=1);

namespace OJS\InstitutionalSubscriptions;

class InstitutionalSubscriptionsDto 
{
    public int $institutionalSubscriptionId;
    public int $subscriptionId;
    public string $institutionName;
    public ?string $mailingAddress;
    public ?string $domain;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->institutionalSubscriptionId = (int) ($row["institutional_subscription_id"] ?? 0);
        $this->subscriptionId = (int) ($row["subscription_id"] ?? 0);
        $this->institutionName = (string) ($row["institution_name"] ?? "");
        $this->mailingAddress = isset($row["mailing_address"]) ? (string) $row["mailing_address"] : null;
        $this->domain = isset($row["domain"]) ? (string) $row["domain"] : null;
    }
}