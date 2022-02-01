<?php

declare(strict_types=1);

namespace OJS\IssueSettings;

use JsonSerializable;

class IssueSettingsModel implements JsonSerializable
{
    private int $issueSettingId;
    private int $issueId;
    private string $locale;
    private string $settingName;
    private ?string $settingValue;
    private ?string $settingType;

    public function __construct(IssueSettingsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->issueSettingId = $dto->issueSettingId;
        $this->issueId = $dto->issueId;
        $this->locale = $dto->locale;
        $this->settingName = $dto->settingName;
        $this->settingValue = $dto->settingValue;
        $this->settingType = $dto->settingType;
    }

    public function getIssueSettingId(): int
    {
        return $this->issueSettingId;
    }

    public function setIssueSettingId(int $issueSettingId): void
    {
        $this->issueSettingId = $issueSettingId;
    }

    public function getIssueId(): int
    {
        return $this->issueId;
    }

    public function setIssueId(int $issueId): void
    {
        $this->issueId = $issueId;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }

    public function getSettingName(): string
    {
        return $this->settingName;
    }

    public function setSettingName(string $settingName): void
    {
        $this->settingName = $settingName;
    }

    public function getSettingValue(): ?string
    {
        return $this->settingValue;
    }

    public function setSettingValue(?string $settingValue): void
    {
        $this->settingValue = $settingValue;
    }

    public function getSettingType(): ?string
    {
        return $this->settingType;
    }

    public function setSettingType(?string $settingType): void
    {
        $this->settingType = $settingType;
    }

    public function toDto(): IssueSettingsDto
    {
        $dto = new IssueSettingsDto();
        $dto->issueSettingId = (int) ($this->issueSettingId ?? 0);
        $dto->issueId = (int) ($this->issueId ?? 0);
        $dto->locale = (string) ($this->locale ?? "");
        $dto->settingName = (string) ($this->settingName ?? "");
        $dto->settingValue = isset($this->settingValue) ? (string) $this->settingValue : null;
        $dto->settingType = isset($this->settingType) ? (string) $this->settingType : null;

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "issue_setting_id" => $this->issueSettingId,
            "issue_id" => $this->issueId,
            "locale" => $this->locale,
            "setting_name" => $this->settingName,
            "setting_value" => $this->settingValue,
            "setting_type" => $this->settingType,
        ];
    }
}