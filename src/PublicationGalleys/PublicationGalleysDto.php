<?php

declare(strict_types=1);

namespace OJS\PublicationGalleys;

class PublicationGalleysDto 
{
    public int $galleyId;
    public ?string $locale;
    public int $publicationId;
    public ?string $label;
    public ?int $submissionFileId;
    public float $seq;
    public ?string $remoteUrl;
    public int $isApproved;
    public ?string $urlPath;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->galleyId = (int) ($row["galley_id"] ?? 0);
        $this->locale = isset($row["locale"]) ? (string) $row["locale"] : null;
        $this->publicationId = (int) ($row["publication_id"] ?? 0);
        $this->label = isset($row["label"]) ? (string) $row["label"] : null;
        $this->submissionFileId = isset($row["submission_file_id"]) ? (int) $row["submission_file_id"] : null;
        $this->seq = (float) ($row["seq"] ?? 0);
        $this->remoteUrl = isset($row["remote_url"]) ? (string) $row["remote_url"] : null;
        $this->isApproved = (int) ($row["is_approved"] ?? 0);
        $this->urlPath = isset($row["url_path"]) ? (string) $row["url_path"] : null;
    }
}