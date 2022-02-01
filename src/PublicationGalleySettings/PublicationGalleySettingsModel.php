<?php

declare(strict_types=1);

namespace OJS\PublicationGalleySettings;

use JsonSerializable;

class PublicationGalleySettingsModel implements JsonSerializable
{
    private int $publicationGalleySettingId;
    private int $galleyId;
    private string $locale;
    private ?string $settingName;
    private string $settingValue;

    public function __construct(PublicationGalleySettingsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->publicationGalleySettingId = $dto->publicationGalleySettingId;
        $this->galleyId = $dto->galleyId;
        $this->locale = $dto->locale;
        $this->settingName = $dto->settingName;
        $this->settingValue = $dto->settingValue;
    }

    public function getPublicationGalleySettingId(): int
    {
        return $this->publicationGalleySettingId;
    }

    public function setPublicationGalleySettingId(int $publicationGalleySettingId): void
    {
        $this->publicationGalleySettingId = $publicationGalleySettingId;
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

    public function getSettingName(): ?string
    {
        return $this->settingName;
    }

    public function setSettingName(?string $settingName): void
    {
        $this->settingName = $settingName;
    }

    public function getSettingValue(): string
    {
        return $this->settingValue;
    }

    public function setSettingValue(string $settingValue): void
    {
        $this->settingValue = $settingValue;
    }

    public function toDto(): PublicationGalleySettingsDto
    {
        $dto = new PublicationGalleySettingsDto();
        $dto->publicationGalleySettingId = (int) ($this->publicationGalleySettingId ?? 0);
        $dto->galleyId = (int) ($this->galleyId ?? 0);
        $dto->locale = (string) ($this->locale ?? "");
        $dto->settingName = isset($this->settingName) ? (string) $this->settingName : null;
        $dto->settingValue = (string) ($this->settingValue ?? "");

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "publication_galley_setting_id" => $this->publicationGalleySettingId,
            "galley_id" => $this->galleyId,
            "locale" => $this->locale,
            "setting_name" => $this->settingName,
            "setting_value" => $this->settingValue,
        ];
    }
}