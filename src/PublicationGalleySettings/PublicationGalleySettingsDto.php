<?php

declare(strict_types=1);

namespace OJS\PublicationGalleySettings;

class PublicationGalleySettingsDto 
{
    public int $publicationGalleySettingId;
    public int $galleyId;
    public string $locale;
    public ?string $settingName;
    public string $settingValue;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->publicationGalleySettingId = (int) ($row["publication_galley_setting_id"] ?? 0);
        $this->galleyId = (int) ($row["galley_id"] ?? 0);
        $this->locale = (string) ($row["locale"] ?? "");
        $this->settingName = isset($row["setting_name"]) ? (string) $row["setting_name"] : null;
        $this->settingValue = (string) ($row["setting_value"] ?? "");
    }
}