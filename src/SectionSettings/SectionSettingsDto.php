<?php

declare(strict_types=1);

namespace OJS\SectionSettings;

class SectionSettingsDto 
{
    public int $sectionSettingId;
    public int $sectionId;
    public string $locale;
    public string $settingName;
    public ?string $settingValue;
    public string $settingType;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->sectionSettingId = (int) ($row["section_setting_id"] ?? 0);
        $this->sectionId = (int) ($row["section_id"] ?? 0);
        $this->locale = (string) ($row["locale"] ?? "");
        $this->settingName = (string) ($row["setting_name"] ?? "");
        $this->settingValue = isset($row["setting_value"]) ? (string) $row["setting_value"] : null;
        $this->settingType = (string) ($row["setting_type"] ?? "");
    }
}