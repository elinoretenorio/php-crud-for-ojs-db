<?php

declare(strict_types=1);

namespace OJS\JournalSettings;

use JsonSerializable;

class JournalSettingsModel implements JsonSerializable
{
    private int $journalSettingId;
    private int $journalId;
    private string $locale;
    private string $settingName;
    private ?string $settingValue;
    private ?string $settingType;

    public function __construct(JournalSettingsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->journalSettingId = $dto->journalSettingId;
        $this->journalId = $dto->journalId;
        $this->locale = $dto->locale;
        $this->settingName = $dto->settingName;
        $this->settingValue = $dto->settingValue;
        $this->settingType = $dto->settingType;
    }

    public function getJournalSettingId(): int
    {
        return $this->journalSettingId;
    }

    public function setJournalSettingId(int $journalSettingId): void
    {
        $this->journalSettingId = $journalSettingId;
    }

    public function getJournalId(): int
    {
        return $this->journalId;
    }

    public function setJournalId(int $journalId): void
    {
        $this->journalId = $journalId;
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

    public function toDto(): JournalSettingsDto
    {
        $dto = new JournalSettingsDto();
        $dto->journalSettingId = (int) ($this->journalSettingId ?? 0);
        $dto->journalId = (int) ($this->journalId ?? 0);
        $dto->locale = (string) ($this->locale ?? "");
        $dto->settingName = (string) ($this->settingName ?? "");
        $dto->settingValue = isset($this->settingValue) ? (string) $this->settingValue : null;
        $dto->settingType = isset($this->settingType) ? (string) $this->settingType : null;

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "journal_setting_id" => $this->journalSettingId,
            "journal_id" => $this->journalId,
            "locale" => $this->locale,
            "setting_name" => $this->settingName,
            "setting_value" => $this->settingValue,
            "setting_type" => $this->settingType,
        ];
    }
}