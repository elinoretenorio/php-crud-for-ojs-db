<?php

declare(strict_types=1);

namespace OJS\InstitutionalSubscriptions;

use JsonSerializable;

class InstitutionalSubscriptionsModel implements JsonSerializable
{
    private int $institutionalSubscriptionId;
    private int $subscriptionId;
    private string $institutionName;
    private ?string $mailingAddress;
    private ?string $domain;

    public function __construct(InstitutionalSubscriptionsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->institutionalSubscriptionId = $dto->institutionalSubscriptionId;
        $this->subscriptionId = $dto->subscriptionId;
        $this->institutionName = $dto->institutionName;
        $this->mailingAddress = $dto->mailingAddress;
        $this->domain = $dto->domain;
    }

    public function getInstitutionalSubscriptionId(): int
    {
        return $this->institutionalSubscriptionId;
    }

    public function setInstitutionalSubscriptionId(int $institutionalSubscriptionId): void
    {
        $this->institutionalSubscriptionId = $institutionalSubscriptionId;
    }

    public function getSubscriptionId(): int
    {
        return $this->subscriptionId;
    }

    public function setSubscriptionId(int $subscriptionId): void
    {
        $this->subscriptionId = $subscriptionId;
    }

    public function getInstitutionName(): string
    {
        return $this->institutionName;
    }

    public function setInstitutionName(string $institutionName): void
    {
        $this->institutionName = $institutionName;
    }

    public function getMailingAddress(): ?string
    {
        return $this->mailingAddress;
    }

    public function setMailingAddress(?string $mailingAddress): void
    {
        $this->mailingAddress = $mailingAddress;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(?string $domain): void
    {
        $this->domain = $domain;
    }

    public function toDto(): InstitutionalSubscriptionsDto
    {
        $dto = new InstitutionalSubscriptionsDto();
        $dto->institutionalSubscriptionId = (int) ($this->institutionalSubscriptionId ?? 0);
        $dto->subscriptionId = (int) ($this->subscriptionId ?? 0);
        $dto->institutionName = (string) ($this->institutionName ?? "");
        $dto->mailingAddress = isset($this->mailingAddress) ? (string) $this->mailingAddress : null;
        $dto->domain = isset($this->domain) ? (string) $this->domain : null;

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "institutional_subscription_id" => $this->institutionalSubscriptionId,
            "subscription_id" => $this->subscriptionId,
            "institution_name" => $this->institutionName,
            "mailing_address" => $this->mailingAddress,
            "domain" => $this->domain,
        ];
    }
}