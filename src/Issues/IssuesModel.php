<?php

declare(strict_types=1);

namespace OJS\Issues;

use JsonSerializable;

class IssuesModel implements JsonSerializable
{
    private int $issueId;
    private int $journalId;
    private ?int $volume;
    private ?string $number;
    private ?int $year;
    private int $published;
    private ?string $datePublished;
    private ?string $dateNotified;
    private ?string $lastModified;
    private int $accessStatus;
    private ?string $openAccessDate;
    private int $showVolume;
    private int $showNumber;
    private int $showYear;
    private int $showTitle;
    private ?string $styleFileName;
    private ?string $originalStyleFileName;
    private ?string $urlPath;

    public function __construct(IssuesDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->issueId = $dto->issueId;
        $this->journalId = $dto->journalId;
        $this->volume = $dto->volume;
        $this->number = $dto->number;
        $this->year = $dto->year;
        $this->published = $dto->published;
        $this->datePublished = $dto->datePublished;
        $this->dateNotified = $dto->dateNotified;
        $this->lastModified = $dto->lastModified;
        $this->accessStatus = $dto->accessStatus;
        $this->openAccessDate = $dto->openAccessDate;
        $this->showVolume = $dto->showVolume;
        $this->showNumber = $dto->showNumber;
        $this->showYear = $dto->showYear;
        $this->showTitle = $dto->showTitle;
        $this->styleFileName = $dto->styleFileName;
        $this->originalStyleFileName = $dto->originalStyleFileName;
        $this->urlPath = $dto->urlPath;
    }

    public function getIssueId(): int
    {
        return $this->issueId;
    }

    public function setIssueId(int $issueId): void
    {
        $this->issueId = $issueId;
    }

    public function getJournalId(): int
    {
        return $this->journalId;
    }

    public function setJournalId(int $journalId): void
    {
        $this->journalId = $journalId;
    }

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(?int $volume): void
    {
        $this->volume = $volume;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): void
    {
        $this->number = $number;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): void
    {
        $this->year = $year;
    }

    public function getPublished(): int
    {
        return $this->published;
    }

    public function setPublished(int $published): void
    {
        $this->published = $published;
    }

    public function getDatePublished(): ?string
    {
        return $this->datePublished;
    }

    public function setDatePublished(?string $datePublished): void
    {
        $this->datePublished = $datePublished;
    }

    public function getDateNotified(): ?string
    {
        return $this->dateNotified;
    }

    public function setDateNotified(?string $dateNotified): void
    {
        $this->dateNotified = $dateNotified;
    }

    public function getLastModified(): ?string
    {
        return $this->lastModified;
    }

    public function setLastModified(?string $lastModified): void
    {
        $this->lastModified = $lastModified;
    }

    public function getAccessStatus(): int
    {
        return $this->accessStatus;
    }

    public function setAccessStatus(int $accessStatus): void
    {
        $this->accessStatus = $accessStatus;
    }

    public function getOpenAccessDate(): ?string
    {
        return $this->openAccessDate;
    }

    public function setOpenAccessDate(?string $openAccessDate): void
    {
        $this->openAccessDate = $openAccessDate;
    }

    public function getShowVolume(): int
    {
        return $this->showVolume;
    }

    public function setShowVolume(int $showVolume): void
    {
        $this->showVolume = $showVolume;
    }

    public function getShowNumber(): int
    {
        return $this->showNumber;
    }

    public function setShowNumber(int $showNumber): void
    {
        $this->showNumber = $showNumber;
    }

    public function getShowYear(): int
    {
        return $this->showYear;
    }

    public function setShowYear(int $showYear): void
    {
        $this->showYear = $showYear;
    }

    public function getShowTitle(): int
    {
        return $this->showTitle;
    }

    public function setShowTitle(int $showTitle): void
    {
        $this->showTitle = $showTitle;
    }

    public function getStyleFileName(): ?string
    {
        return $this->styleFileName;
    }

    public function setStyleFileName(?string $styleFileName): void
    {
        $this->styleFileName = $styleFileName;
    }

    public function getOriginalStyleFileName(): ?string
    {
        return $this->originalStyleFileName;
    }

    public function setOriginalStyleFileName(?string $originalStyleFileName): void
    {
        $this->originalStyleFileName = $originalStyleFileName;
    }

    public function getUrlPath(): ?string
    {
        return $this->urlPath;
    }

    public function setUrlPath(?string $urlPath): void
    {
        $this->urlPath = $urlPath;
    }

    public function toDto(): IssuesDto
    {
        $dto = new IssuesDto();
        $dto->issueId = (int) ($this->issueId ?? 0);
        $dto->journalId = (int) ($this->journalId ?? 0);
        $dto->volume = isset($this->volume) ? (int) $this->volume : null;
        $dto->number = isset($this->number) ? (string) $this->number : null;
        $dto->year = isset($this->year) ? (int) $this->year : null;
        $dto->published = (int) ($this->published ?? 0);
        $dto->datePublished = isset($this->datePublished) ? (string) $this->datePublished : null;
        $dto->dateNotified = isset($this->dateNotified) ? (string) $this->dateNotified : null;
        $dto->lastModified = isset($this->lastModified) ? (string) $this->lastModified : null;
        $dto->accessStatus = (int) ($this->accessStatus ?? 1);
        $dto->openAccessDate = isset($this->openAccessDate) ? (string) $this->openAccessDate : null;
        $dto->showVolume = (int) ($this->showVolume ?? 0);
        $dto->showNumber = (int) ($this->showNumber ?? 0);
        $dto->showYear = (int) ($this->showYear ?? 0);
        $dto->showTitle = (int) ($this->showTitle ?? 0);
        $dto->styleFileName = isset($this->styleFileName) ? (string) $this->styleFileName : null;
        $dto->originalStyleFileName = isset($this->originalStyleFileName) ? (string) $this->originalStyleFileName : null;
        $dto->urlPath = isset($this->urlPath) ? (string) $this->urlPath : null;

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "issue_id" => $this->issueId,
            "journal_id" => $this->journalId,
            "volume" => $this->volume,
            "number" => $this->number,
            "year" => $this->year,
            "published" => $this->published,
            "date_published" => $this->datePublished,
            "date_notified" => $this->dateNotified,
            "last_modified" => $this->lastModified,
            "access_status" => $this->accessStatus,
            "open_access_date" => $this->openAccessDate,
            "show_volume" => $this->showVolume,
            "show_number" => $this->showNumber,
            "show_year" => $this->showYear,
            "show_title" => $this->showTitle,
            "style_file_name" => $this->styleFileName,
            "original_style_file_name" => $this->originalStyleFileName,
            "url_path" => $this->urlPath,
        ];
    }
}