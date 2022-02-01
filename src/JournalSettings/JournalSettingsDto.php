<?php

declare(strict_types=1);

namespace OJS\JournalSettings;

class JournalSettingsDto 
{
    public int $journalSettingId;
    public int $journalId;
    public string $locale;
    public string $settingName;
    public ?string $settingValue;
    public ?string $settingType;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->journalSettingId = (int) ($row["journal_setting_id"] ?? 0);
        $this->journalId = (int) ($row["journal_id"] ?? 0);
        $this->locale = (string) ($row["locale"] ?? "");
        $this->settingName = (string) ($row["setting_name"] ?? "");
        $this->settingValue = isset($row["setting_value"]) ? (string) $row["setting_value"] : null;
        $this->settingType = isset($row["setting_type"]) ? (string) $row["setting_type"] : null;
    }
}