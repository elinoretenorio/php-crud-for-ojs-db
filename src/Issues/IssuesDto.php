<?php

declare(strict_types=1);

namespace OJS\Issues;

class IssuesDto 
{
    public int $issueId;
    public int $journalId;
    public ?int $volume;
    public ?string $number;
    public ?int $year;
    public int $published;
    public ?string $datePublished;
    public ?string $dateNotified;
    public ?string $lastModified;
    public int $accessStatus;
    public ?string $openAccessDate;
    public int $showVolume;
    public int $showNumber;
    public int $showYear;
    public int $showTitle;
    public ?string $styleFileName;
    public ?string $originalStyleFileName;
    public ?string $urlPath;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->issueId = (int) ($row["issue_id"] ?? 0);
        $this->journalId = (int) ($row["journal_id"] ?? 0);
        $this->volume = isset($row["volume"]) ? (int) $row["volume"] : null;
        $this->number = isset($row["number"]) ? (string) $row["number"] : null;
        $this->year = isset($row["year"]) ? (int) $row["year"] : null;
        $this->published = (int) ($row["published"] ?? 0);
        $this->datePublished = isset($row["date_published"]) ? (string) $row["date_published"] : null;
        $this->dateNotified = isset($row["date_notified"]) ? (string) $row["date_notified"] : null;
        $this->lastModified = isset($row["last_modified"]) ? (string) $row["last_modified"] : null;
        $this->accessStatus = (int) ($row["access_status"] ?? 1);
        $this->openAccessDate = isset($row["open_access_date"]) ? (string) $row["open_access_date"] : null;
        $this->showVolume = (int) ($row["show_volume"] ?? 0);
        $this->showNumber = (int) ($row["show_number"] ?? 0);
        $this->showYear = (int) ($row["show_year"] ?? 0);
        $this->showTitle = (int) ($row["show_title"] ?? 0);
        $this->styleFileName = isset($row["style_file_name"]) ? (string) $row["style_file_name"] : null;
        $this->originalStyleFileName = isset($row["original_style_file_name"]) ? (string) $row["original_style_file_name"] : null;
        $this->urlPath = isset($row["url_path"]) ? (string) $row["url_path"] : null;
    }
}