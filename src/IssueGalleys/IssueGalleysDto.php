<?php

declare(strict_types=1);

namespace OJS\IssueGalleys;

class IssueGalleysDto 
{
    public int $galleyId;
    public string $locale;
    public int $issueId;
    public int $fileId;
    public ?string $label;
    public float $seq;
    public ?string $urlPath;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->galleyId = (int) ($row["galley_id"] ?? 0);
        $this->locale = (string) ($row["locale"] ?? "");
        $this->issueId = (int) ($row["issue_id"] ?? 0);
        $this->fileId = (int) ($row["file_id"] ?? 0);
        $this->label = isset($row["label"]) ? (string) $row["label"] : null;
        $this->seq = (float) ($row["seq"] ?? 0);
        $this->urlPath = isset($row["url_path"]) ? (string) $row["url_path"] : null;
    }
}