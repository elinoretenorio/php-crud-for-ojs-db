<?php

declare(strict_types=1);

namespace OJS\IssueGalleySettings;

class IssueGalleySettingsDto 
{
    public int $issueGalleySettingId;
    public int $galleyId;
    public string $locale;
    public string $settingName;
    public ?string $settingValue;
    public string $settingType;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->issueGalleySettingId = (int) ($row["issue_galley_setting_id"] ?? 0);
        $this->galleyId = (int) ($row["galley_id"] ?? 0);
        $this->locale = (string) ($row["locale"] ?? "");
        $this->settingName = (string) ($row["setting_name"] ?? "");
        $this->settingValue = isset($row["setting_value"]) ? (string) $row["setting_value"] : null;
        $this->settingType = (string) ($row["setting_type"] ?? "");
    }
}