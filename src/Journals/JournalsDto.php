<?php

declare(strict_types=1);

namespace OJS\Journals;

class JournalsDto 
{
    public int $journalId;
    public string $path;
    public float $seq;
    public string $primaryLocale;
    public int $enabled;
    public ?int $currentIssueId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->journalId = (int) ($row["journal_id"] ?? 0);
        $this->path = (string) ($row["path"] ?? "");
        $this->seq = (float) ($row["seq"] ?? 0);
        $this->primaryLocale = (string) ($row["primary_locale"] ?? "");
        $this->enabled = (int) ($row["enabled"] ?? 1);
        $this->currentIssueId = isset($row["current_issue_id"]) ? (int) $row["current_issue_id"] : null;
    }
}