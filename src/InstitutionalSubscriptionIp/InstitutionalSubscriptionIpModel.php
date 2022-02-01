<?php

declare(strict_types=1);

namespace OJS\InstitutionalSubscriptionIp;

use JsonSerializable;

class InstitutionalSubscriptionIpModel implements JsonSerializable
{
    private int $institutionalSubscriptionIpId;
    private int $subscriptionId;
    private string $ipString;
    private int $ipStart;
    private ?int $ipEnd;

    public function __construct(InstitutionalSubscriptionIpDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->institutionalSubscriptionIpId = $dto->institutionalSubscriptionIpId;
        $this->subscriptionId = $dto->subscriptionId;
        $this->ipString = $dto->ipString;
        $this->ipStart = $dto->ipStart;
        $this->ipEnd = $dto->ipEnd;
    }

    public function getInstitutionalSubscriptionIpId(): int
    {
        return $this->institutionalSubscriptionIpId;
    }

    public function setInstitutionalSubscriptionIpId(int $institutionalSubscriptionIpId): void
    {
        $this->institutionalSubscriptionIpId = $institutionalSubscriptionIpId;
    }

    public function getSubscriptionId(): int
    {
        return $this->subscriptionId;
    }

    public function setSubscriptionId(int $subscriptionId): void
    {
        $this->subscriptionId = $subscriptionId;
    }

    public function getIpString(): string
    {
        return $this->ipString;
    }

    public function setIpString(string $ipString): void
    {
        $this->ipString = $ipString;
    }

    public function getIpStart(): int
    {
        return $this->ipStart;
    }

    public function setIpStart(int $ipStart): void
    {
        $this->ipStart = $ipStart;
    }

    public function getIpEnd(): ?int
    {
        return $this->ipEnd;
    }

    public function setIpEnd(?int $ipEnd): void
    {
        $this->ipEnd = $ipEnd;
    }

    public function toDto(): InstitutionalSubscriptionIpDto
    {
        $dto = new InstitutionalSubscriptionIpDto();
        $dto->institutionalSubscriptionIpId = (int) ($this->institutionalSubscriptionIpId ?? 0);
        $dto->subscriptionId = (int) ($this->subscriptionId ?? 0);
        $dto->ipString = (string) ($this->ipString ?? "");
        $dto->ipStart = (int) ($this->ipStart ?? 0);
        $dto->ipEnd = isset($this->ipEnd) ? (int) $this->ipEnd : null;

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "institutional_subscription_ip_id" => $this->institutionalSubscriptionIpId,
            "subscription_id" => $this->subscriptionId,
            "ip_string" => $this->ipString,
            "ip_start" => $this->ipStart,
            "ip_end" => $this->ipEnd,
        ];
    }
}