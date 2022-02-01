<?php

declare(strict_types=1);

namespace OJS\Publications;

use JsonSerializable;

class PublicationsModel implements JsonSerializable
{
    private int $publicationId;
    private ?int $accessStatus;
    private ?string $datePublished;
    private ?string $lastModified;
    private ?int $primaryContactId;
    private ?int $sectionId;
    private float $seq;
    private int $submissionId;
    private int $status;
    private ?string $urlPath;
    private ?int $version;

    public function __construct(PublicationsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->publicationId = $dto->publicationId;
        $this->accessStatus = $dto->accessStatus;
        $this->datePublished = $dto->datePublished;
        $this->lastModified = $dto->lastModified;
        $this->primaryContactId = $dto->primaryContactId;
        $this->sectionId = $dto->sectionId;
        $this->seq = $dto->seq;
        $this->submissionId = $dto->submissionId;
        $this->status = $dto->status;
        $this->urlPath = $dto->urlPath;
        $this->version = $dto->version;
    }

    public function getPublicationId(): int
    {
        return $this->publicationId;
    }

    public function setPublicationId(int $publicationId): void
    {
        $this->publicationId = $publicationId;
    }

    public function getAccessStatus(): ?int
    {
        return $this->accessStatus;
    }

    public function setAccessStatus(?int $accessStatus): void
    {
        $this->accessStatus = $accessStatus;
    }

    public function getDatePublished(): ?string
    {
        return $this->datePublished;
    }

    public function setDatePublished(?string $datePublished): void
    {
        $this->datePublished = $datePublished;
    }

    public function getLastModified(): ?string
    {
        return $this->lastModified;
    }

    public function setLastModified(?string $lastModified): void
    {
        $this->lastModified = $lastModified;
    }

    public function getPrimaryContactId(): ?int
    {
        return $this->primaryContactId;
    }

    public function setPrimaryContactId(?int $primaryContactId): void
    {
        $this->primaryContactId = $primaryContactId;
    }

    public function getSectionId(): ?int
    {
        return $this->sectionId;
    }

    public function setSectionId(?int $sectionId): void
    {
        $this->sectionId = $sectionId;
    }

    public function getSeq(): float
    {
        return $this->seq;
    }

    public function setSeq(float $seq): void
    {
        $this->seq = $seq;
    }

    public function getSubmissionId(): int
    {
        return $this->submissionId;
    }

    public function setSubmissionId(int $submissionId): void
    {
        $this->submissionId = $submissionId;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getUrlPath(): ?string
    {
        return $this->urlPath;
    }

    public function setUrlPath(?string $urlPath): void
    {
        $this->urlPath = $urlPath;
    }

    public function getVersion(): ?int
    {
        return $this->version;
    }

    public function setVersion(?int $version): void
    {
        $this->version = $version;
    }

    public function toDto(): PublicationsDto
    {
        $dto = new PublicationsDto();
        $dto->publicationId = (int) ($this->publicationId ?? 0);
        $dto->accessStatus = isset($this->accessStatus) ? (int) $this->accessStatus : null;
        $dto->datePublished = isset($this->datePublished) ? (string) $this->datePublished : null;
        $dto->lastModified = isset($this->lastModified) ? (string) $this->lastModified : null;
        $dto->primaryContactId = isset($this->primaryContactId) ? (int) $this->primaryContactId : null;
        $dto->sectionId = isset($this->sectionId) ? (int) $this->sectionId : null;
        $dto->seq = (float) ($this->seq ?? 0);
        $dto->submissionId = (int) ($this->submissionId ?? 0);
        $dto->status = (int) ($this->status ?? 1);
        $dto->urlPath = isset($this->urlPath) ? (string) $this->urlPath : null;
        $dto->version = isset($this->version) ? (int) $this->version : null;

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "publication_id" => $this->publicationId,
            "access_status" => $this->accessStatus,
            "date_published" => $this->datePublished,
            "last_modified" => $this->lastModified,
            "primary_contact_id" => $this->primaryContactId,
            "section_id" => $this->sectionId,
            "seq" => $this->seq,
            "submission_id" => $this->submissionId,
            "status" => $this->status,
            "url_path" => $this->urlPath,
            "version" => $this->version,
        ];
    }
}