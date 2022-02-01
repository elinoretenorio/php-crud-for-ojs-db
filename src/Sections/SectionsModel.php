<?php

declare(strict_types=1);

namespace OJS\Sections;

use JsonSerializable;

class SectionsModel implements JsonSerializable
{
    private int $sectionId;
    private int $journalId;
    private ?int $reviewFormId;
    private float $seq;
    private int $editorRestricted;
    private int $metaIndexed;
    private int $metaReviewed;
    private int $abstractsNotRequired;
    private int $hideTitle;
    private int $hideAuthor;
    private int $isInactive;
    private ?int $abstractWordCount;

    public function __construct(SectionsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->sectionId = $dto->sectionId;
        $this->journalId = $dto->journalId;
        $this->reviewFormId = $dto->reviewFormId;
        $this->seq = $dto->seq;
        $this->editorRestricted = $dto->editorRestricted;
        $this->metaIndexed = $dto->metaIndexed;
        $this->metaReviewed = $dto->metaReviewed;
        $this->abstractsNotRequired = $dto->abstractsNotRequired;
        $this->hideTitle = $dto->hideTitle;
        $this->hideAuthor = $dto->hideAuthor;
        $this->isInactive = $dto->isInactive;
        $this->abstractWordCount = $dto->abstractWordCount;
    }

    public function getSectionId(): int
    {
        return $this->sectionId;
    }

    public function setSectionId(int $sectionId): void
    {
        $this->sectionId = $sectionId;
    }

    public function getJournalId(): int
    {
        return $this->journalId;
    }

    public function setJournalId(int $journalId): void
    {
        $this->journalId = $journalId;
    }

    public function getReviewFormId(): ?int
    {
        return $this->reviewFormId;
    }

    public function setReviewFormId(?int $reviewFormId): void
    {
        $this->reviewFormId = $reviewFormId;
    }

    public function getSeq(): float
    {
        return $this->seq;
    }

    public function setSeq(float $seq): void
    {
        $this->seq = $seq;
    }

    public function getEditorRestricted(): int
    {
        return $this->editorRestricted;
    }

    public function setEditorRestricted(int $editorRestricted): void
    {
        $this->editorRestricted = $editorRestricted;
    }

    public function getMetaIndexed(): int
    {
        return $this->metaIndexed;
    }

    public function setMetaIndexed(int $metaIndexed): void
    {
        $this->metaIndexed = $metaIndexed;
    }

    public function getMetaReviewed(): int
    {
        return $this->metaReviewed;
    }

    public function setMetaReviewed(int $metaReviewed): void
    {
        $this->metaReviewed = $metaReviewed;
    }

    public function getAbstractsNotRequired(): int
    {
        return $this->abstractsNotRequired;
    }

    public function setAbstractsNotRequired(int $abstractsNotRequired): void
    {
        $this->abstractsNotRequired = $abstractsNotRequired;
    }

    public function getHideTitle(): int
    {
        return $this->hideTitle;
    }

    public function setHideTitle(int $hideTitle): void
    {
        $this->hideTitle = $hideTitle;
    }

    public function getHideAuthor(): int
    {
        return $this->hideAuthor;
    }

    public function setHideAuthor(int $hideAuthor): void
    {
        $this->hideAuthor = $hideAuthor;
    }

    public function getIsInactive(): int
    {
        return $this->isInactive;
    }

    public function setIsInactive(int $isInactive): void
    {
        $this->isInactive = $isInactive;
    }

    public function getAbstractWordCount(): ?int
    {
        return $this->abstractWordCount;
    }

    public function setAbstractWordCount(?int $abstractWordCount): void
    {
        $this->abstractWordCount = $abstractWordCount;
    }

    public function toDto(): SectionsDto
    {
        $dto = new SectionsDto();
        $dto->sectionId = (int) ($this->sectionId ?? 0);
        $dto->journalId = (int) ($this->journalId ?? 0);
        $dto->reviewFormId = isset($this->reviewFormId) ? (int) $this->reviewFormId : null;
        $dto->seq = (float) ($this->seq ?? 0);
        $dto->editorRestricted = (int) ($this->editorRestricted ?? 0);
        $dto->metaIndexed = (int) ($this->metaIndexed ?? 0);
        $dto->metaReviewed = (int) ($this->metaReviewed ?? 1);
        $dto->abstractsNotRequired = (int) ($this->abstractsNotRequired ?? 0);
        $dto->hideTitle = (int) ($this->hideTitle ?? 0);
        $dto->hideAuthor = (int) ($this->hideAuthor ?? 0);
        $dto->isInactive = (int) ($this->isInactive ?? 0);
        $dto->abstractWordCount = isset($this->abstractWordCount) ? (int) $this->abstractWordCount : null;

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "section_id" => $this->sectionId,
            "journal_id" => $this->journalId,
            "review_form_id" => $this->reviewFormId,
            "seq" => $this->seq,
            "editor_restricted" => $this->editorRestricted,
            "meta_indexed" => $this->metaIndexed,
            "meta_reviewed" => $this->metaReviewed,
            "abstracts_not_required" => $this->abstractsNotRequired,
            "hide_title" => $this->hideTitle,
            "hide_author" => $this->hideAuthor,
            "is_inactive" => $this->isInactive,
            "abstract_word_count" => $this->abstractWordCount,
        ];
    }
}