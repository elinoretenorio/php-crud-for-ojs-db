<?php

declare(strict_types=1);

namespace OJS\IssueGalleySettings;

use JsonSerializable;

class IssueGalleySettingsModel implements JsonSerializable
{
    private int $issueGalleySettingId;
    private int $galleyId;
    private string $locale;
    private string $settingName;
    private ?string $settingValue;
    private string $settingType;

    public function __construct(IssueGalleySettingsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->issueGalleySettingId = $dto->issueGalleySettingId;
        $this->galleyId = $dto->galleyId;
        $this->locale = $dto->locale;
        $this->settingName = $dto->settingName;
        $this->settingValue = $dto->settingValue;
        $this->settingType = $dto->settingType;
    }

    public function getIssueGalleySettingId(): int
    {
        return $this->issueGalleySettingId;
    }

    public function setIssueGalleySettingId(int $issueGalleySettingId): void
    {
        $this->issueGalleySettingId = $issueGalleySettingId;
    }

    public function getGalleyId(): int
    {
        return $this->galleyId;
    }

    public function setGalleyId(int $galleyId): void
    {
        $this->galleyId = $galleyId;
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

    public function getSettingType(): string
    {
        return $this->settingType;
    }

    public function setSettingType(string $settingType): void
    {
        $this->settingType = $settingType;
    }

    public function toDto(): IssueGalleySettingsDto
    {
        $dto = new IssueGalleySettingsDto();
        $dto->issueGalleySettingId = (int) ($this->issueGalleySettingId ?? 0);
        $dto->galleyId = (int) ($this->galleyId ?? 0);
        $dto->locale = (string) ($this->locale ?? "");
        $dto->settingName = (string) ($this->settingName ?? "");
        $dto->settingValue = isset($this->settingValue) ? (string) $this->settingValue : null;
        $dto->settingType = (string) ($this->settingType ?? "");

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "issue_galley_setting_id" => $this->issueGalleySettingId,
            "galley_id" => $this->galleyId,
            "locale" => $this->locale,
            "setting_name" => $this->settingName,
            "setting_value" => $this->settingValue,
            "setting_type" => $this->settingType,
        ];
    }
}