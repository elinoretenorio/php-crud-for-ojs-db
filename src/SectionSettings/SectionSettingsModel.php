<?php

declare(strict_types=1);

namespace OJS\SectionSettings;

use JsonSerializable;

class SectionSettingsModel implements JsonSerializable
{
    private int $sectionSettingId;
    private int $sectionId;
    private string $locale;
    private string $settingName;
    private ?string $settingValue;
    private string $settingType;

    public function __construct(SectionSettingsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->sectionSettingId = $dto->sectionSettingId;
        $this->sectionId = $dto->sectionId;
        $this->locale = $dto->locale;
        $this->settingName = $dto->settingName;
        $this->settingValue = $dto->settingValue;
        $this->settingType = $dto->settingType;
    }

    public function getSectionSettingId(): int
    {
        return $this->sectionSettingId;
    }

    public function setSectionSettingId(int $sectionSettingId): void
    {
        $this->sectionSettingId = $sectionSettingId;
    }

    public function getSectionId(): int
    {
        return $this->sectionId;
    }

    public function setSectionId(int $sectionId): void
    {
        $this->sectionId = $sectionId;
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

    public function toDto(): SectionSettingsDto
    {
        $dto = new SectionSettingsDto();
        $dto->sectionSettingId = (int) ($this->sectionSettingId ?? 0);
        $dto->sectionId = (int) ($this->sectionId ?? 0);
        $dto->locale = (string) ($this->locale ?? "");
        $dto->settingName = (string) ($this->settingName ?? "");
        $dto->settingValue = isset($this->settingValue) ? (string) $this->settingValue : null;
        $dto->settingType = (string) ($this->settingType ?? "");

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "section_setting_id" => $this->sectionSettingId,
            "section_id" => $this->sectionId,
            "locale" => $this->locale,
            "setting_name" => $this->settingName,
            "setting_value" => $this->settingValue,
            "setting_type" => $this->settingType,
        ];
    }
}