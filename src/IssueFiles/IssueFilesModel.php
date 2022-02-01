<?php

declare(strict_types=1);

namespace OJS\IssueFiles;

use JsonSerializable;

class IssueFilesModel implements JsonSerializable
{
    private int $fileId;
    private int $issueId;
    private string $fileName;
    private string $fileType;
    private int $fileSize;
    private int $contentType;
    private ?string $originalFileName;
    private string $dateUploaded;
    private string $dateModified;

    public function __construct(IssueFilesDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->fileId = $dto->fileId;
        $this->issueId = $dto->issueId;
        $this->fileName = $dto->fileName;
        $this->fileType = $dto->fileType;
        $this->fileSize = $dto->fileSize;
        $this->contentType = $dto->contentType;
        $this->originalFileName = $dto->originalFileName;
        $this->dateUploaded = $dto->dateUploaded;
        $this->dateModified = $dto->dateModified;
    }

    public function getFileId(): int
    {
        return $this->fileId;
    }

    public function setFileId(int $fileId): void
    {
        $this->fileId = $fileId;
    }

    public function getIssueId(): int
    {
        return $this->issueId;
    }

    public function setIssueId(int $issueId): void
    {
        $this->issueId = $issueId;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
    }

    public function getFileType(): string
    {
        return $this->fileType;
    }

    public function setFileType(string $fileType): void
    {
        $this->fileType = $fileType;
    }

    public function getFileSize(): int
    {
        return $this->fileSize;
    }

    public function setFileSize(int $fileSize): void
    {
        $this->fileSize = $fileSize;
    }

    public function getContentType(): int
    {
        return $this->contentType;
    }

    public function setContentType(int $contentType): void
    {
        $this->contentType = $contentType;
    }

    public function getOriginalFileName(): ?string
    {
        return $this->originalFileName;
    }

    public function setOriginalFileName(?string $originalFileName): void
    {
        $this->originalFileName = $originalFileName;
    }

    public function getDateUploaded(): string
    {
        return $this->dateUploaded;
    }

    public function setDateUploaded(string $dateUploaded): void
    {
        $this->dateUploaded = $dateUploaded;
    }

    public function getDateModified(): string
    {
        return $this->dateModified;
    }

    public function setDateModified(string $dateModified): void
    {
        $this->dateModified = $dateModified;
    }

    public function toDto(): IssueFilesDto
    {
        $dto = new IssueFilesDto();
        $dto->fileId = (int) ($this->fileId ?? 0);
        $dto->issueId = (int) ($this->issueId ?? 0);
        $dto->fileName = (string) ($this->fileName ?? "");
        $dto->fileType = (string) ($this->fileType ?? "");
        $dto->fileSize = (int) ($this->fileSize ?? 0);
        $dto->contentType = (int) ($this->contentType ?? 0);
        $dto->originalFileName = isset($this->originalFileName) ? (string) $this->originalFileName : null;
        $dto->dateUploaded = (string) ($this->dateUploaded ?? "");
        $dto->dateModified = (string) ($this->dateModified ?? "");

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "file_id" => $this->fileId,
            "issue_id" => $this->issueId,
            "file_name" => $this->fileName,
            "file_type" => $this->fileType,
            "file_size" => $this->fileSize,
            "content_type" => $this->contentType,
            "original_file_name" => $this->originalFileName,
            "date_uploaded" => $this->dateUploaded,
            "date_modified" => $this->dateModified,
        ];
    }
}