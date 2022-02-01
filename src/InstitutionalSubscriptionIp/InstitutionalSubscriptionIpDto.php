<?php

declare(strict_types=1);

namespace OJS\InstitutionalSubscriptionIp;

class InstitutionalSubscriptionIpDto 
{
    public int $institutionalSubscriptionIpId;
    public int $subscriptionId;
    public string $ipString;
    public int $ipStart;
    public ?int $ipEnd;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->institutionalSubscriptionIpId = (int) ($row["institutional_subscription_ip_id"] ?? 0);
        $this->subscriptionId = (int) ($row["subscription_id"] ?? 0);
        $this->ipString = (string) ($row["ip_string"] ?? "");
        $this->ipStart = (int) ($row["ip_start"] ?? 0);
        $this->ipEnd = isset($row["ip_end"]) ? (int) $row["ip_end"] : null;
    }
}