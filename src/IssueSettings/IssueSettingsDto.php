<?php

declare(strict_types=1);

namespace OJS\IssueSettings;

class IssueSettingsDto 
{
    public int $issueSettingId;
    public int $issueId;
    public string $locale;
    public string $settingName;
    public ?string $settingValue;
    public ?string $settingType;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->issueSettingId = (int) ($row["issue_setting_id"] ?? 0);
        $this->issueId = (int) ($row["issue_id"] ?? 0);
        $this->locale = (string) ($row["locale"] ?? "");
        $this->settingName = (string) ($row["setting_name"] ?? "");
        $this->settingValue = isset($row["setting_value"]) ? (string) $row["setting_value"] : null;
        $this->settingType = isset($row["setting_type"]) ? (string) $row["setting_type"] : null;
    }
}