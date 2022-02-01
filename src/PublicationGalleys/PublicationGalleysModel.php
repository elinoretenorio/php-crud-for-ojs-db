<?php

declare(strict_types=1);

namespace OJS\PublicationGalleys;

use JsonSerializable;

class PublicationGalleysModel implements JsonSerializable
{
    private int $galleyId;
    private ?string $locale;
    private int $publicationId;
    private ?string $label;
    private ?int $submissionFileId;
    private float $seq;
    private ?string $remoteUrl;
    private int $isApproved;
    private ?string $urlPath;

    public function __construct(PublicationGalleysDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->galleyId = $dto->galleyId;
        $this->locale = $dto->locale;
        $this->publicationId = $dto->publicationId;
        $this->label = $dto->label;
        $this->submissionFileId = $dto->submissionFileId;
        $this->seq = $dto->seq;
        $this->remoteUrl = $dto->remoteUrl;
        $this->isApproved = $dto->isApproved;
        $this->urlPath = $dto->urlPath;
    }

    public function getGalleyId(): int
    {
        return $this->galleyId;
    }

    public function setGalleyId(int $galleyId): void
    {
        $this->galleyId = $galleyId;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(?string $locale): void
    {
        $this->locale = $locale;
    }

    public function getPublicationId(): int
    {
        return $this->publicationId;
    }

    public function setPublicationId(int $publicationId): void
    {
        $this->publicationId = $publicationId;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): void
    {
        $this->label = $label;
    }

    public function getSubmissionFileId(): ?int
    {
        return $this->submissionFileId;
    }

    public function setSubmissionFileId(?int $submissionFileId): void
    {
        $this->submissionFileId = $submissionFileId;
    }

    public function getSeq(): float
    {
        return $this->seq;
    }

    public function setSeq(float $seq): void
    {
        $this->seq = $seq;
    }

    public function getRemoteUrl(): ?string
    {
        return $this->remoteUrl;
    }

    public function setRemoteUrl(?string $remoteUrl): void
    {
        $this->remoteUrl = $remoteUrl;
    }

    public function getIsApproved(): int
    {
        return $this->isApproved;
    }

    public function setIsApproved(int $isApproved): void
    {
        $this->isApproved = $isApproved;
    }

    public function getUrlPath(): ?string
    {
        return $this->urlPath;
    }

    public function setUrlPath(?string $urlPath): void
    {
        $this->urlPath = $urlPath;
    }

    public function toDto(): PublicationGalleysDto
    {
        $dto = new PublicationGalleysDto();
        $dto->galleyId = (int) ($this->galleyId ?? 0);
        $dto->locale = isset($this->locale) ? (string) $this->locale : null;
        $dto->publicationId = (int) ($this->publicationId ?? 0);
        $dto->label = isset($this->label) ? (string) $this->label : null;
        $dto->submissionFileId = isset($this->submissionFileId) ? (int) $this->submissionFileId : null;
        $dto->seq = (float) ($this->seq ?? 0);
        $dto->remoteUrl = isset($this->remoteUrl) ? (string) $this->remoteUrl : null;
        $dto->isApproved = (int) ($this->isApproved ?? 0);
        $dto->urlPath = isset($this->urlPath) ? (string) $this->urlPath : null;

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "galley_id" => $this->galleyId,
            "locale" => $this->locale,
            "publication_id" => $this->publicationId,
            "label" => $this->label,
            "submission_file_id" => $this->submissionFileId,
            "seq" => $this->seq,
            "remote_url" => $this->remoteUrl,
            "is_approved" => $this->isApproved,
            "url_path" => $this->urlPath,
        ];
    }
}