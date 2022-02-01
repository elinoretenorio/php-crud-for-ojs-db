<?php

declare(strict_types=1);

namespace OJS\IssueFiles;

class IssueFilesDto 
{
    public int $fileId;
    public int $issueId;
    public string $fileName;
    public string $fileType;
    public int $fileSize;
    public int $contentType;
    public ?string $originalFileName;
    public string $dateUploaded;
    public string $dateModified;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->fileId = (int) ($row["file_id"] ?? 0);
        $this->issueId = (int) ($row["issue_id"] ?? 0);
        $this->fileName = (string) ($row["file_name"] ?? "");
        $this->fileType = (string) ($row["file_type"] ?? "");
        $this->fileSize = (int) ($row["file_size"] ?? 0);
        $this->contentType = (int) ($row["content_type"] ?? 0);
        $this->originalFileName = isset($row["original_file_name"]) ? (string) $row["original_file_name"] : null;
        $this->dateUploaded = (string) ($row["date_uploaded"] ?? "");
        $this->dateModified = (string) ($row["date_modified"] ?? "");
    }
}