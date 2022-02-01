<?php

declare(strict_types=1);

namespace OJS\IssueGalleys;

use JsonSerializable;

class IssueGalleysModel implements JsonSerializable
{
    private int $galleyId;
    private string $locale;
    private int $issueId;
    private int $fileId;
    private ?string $label;
    private float $seq;
    private ?string $urlPath;

    public function __construct(IssueGalleysDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->galleyId = $dto->galleyId;
        $this->locale = $dto->locale;
        $this->issueId = $dto->issueId;
        $this->fileId = $dto->fileId;
        $this->label = $dto->label;
        $this->seq = $dto->seq;
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

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }

    public function getIssueId(): int
    {
        return $this->issueId;
    }

    public function setIssueId(int $issueId): void
    {
        $this->issueId = $issueId;
    }

    public function getFileId(): int
    {
        return $this->fileId;
    }

    public function setFileId(int $fileId): void
    {
        $this->fileId = $fileId;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): void
    {
        $this->label = $label;
    }

    public function getSeq(): float
    {
        return $this->seq;
    }

    public function setSeq(float $seq): void
    {
        $this->seq = $seq;
    }

    public function getUrlPath(): ?string
    {
        return $this->urlPath;
    }

    public function setUrlPath(?string $urlPath): void
    {
        $this->urlPath = $urlPath;
    }

    public function toDto(): IssueGalleysDto
    {
        $dto = new IssueGalleysDto();
        $dto->galleyId = (int) ($this->galleyId ?? 0);
        $dto->locale = (string) ($this->locale ?? "");
        $dto->issueId = (int) ($this->issueId ?? 0);
        $dto->fileId = (int) ($this->fileId ?? 0);
        $dto->label = isset($this->label) ? (string) $this->label : null;
        $dto->seq = (float) ($this->seq ?? 0);
        $dto->urlPath = isset($this->urlPath) ? (string) $this->urlPath : null;

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "galley_id" => $this->galleyId,
            "locale" => $this->locale,
            "issue_id" => $this->issueId,
            "file_id" => $this->fileId,
            "label" => $this->label,
            "seq" => $this->seq,
            "url_path" => $this->urlPath,
        ];
    }
}