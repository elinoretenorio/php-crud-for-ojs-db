<?php

declare(strict_types=1);

namespace OJS\Publications;

class PublicationsDto 
{
    public int $publicationId;
    public ?int $accessStatus;
    public ?string $datePublished;
    public ?string $lastModified;
    public ?int $primaryContactId;
    public ?int $sectionId;
    public float $seq;
    public int $submissionId;
    public int $status;
    public ?string $urlPath;
    public ?int $version;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->publicationId = (int) ($row["publication_id"] ?? 0);
        $this->accessStatus = isset($row["access_status"]) ? (int) $row["access_status"] : null;
        $this->datePublished = isset($row["date_published"]) ? (string) $row["date_published"] : null;
        $this->lastModified = isset($row["last_modified"]) ? (string) $row["last_modified"] : null;
        $this->primaryContactId = isset($row["primary_contact_id"]) ? (int) $row["primary_contact_id"] : null;
        $this->sectionId = isset($row["section_id"]) ? (int) $row["section_id"] : null;
        $this->seq = (float) ($row["seq"] ?? 0);
        $this->submissionId = (int) ($row["submission_id"] ?? 0);
        $this->status = (int) ($row["status"] ?? 1);
        $this->urlPath = isset($row["url_path"]) ? (string) $row["url_path"] : null;
        $this->version = isset($row["version"]) ? (int) $row["version"] : null;
    }
}