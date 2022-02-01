<?php

declare(strict_types=1);

namespace OJS\Sections;

class SectionsDto 
{
    public int $sectionId;
    public int $journalId;
    public ?int $reviewFormId;
    public float $seq;
    public int $editorRestricted;
    public int $metaIndexed;
    public int $metaReviewed;
    public int $abstractsNotRequired;
    public int $hideTitle;
    public int $hideAuthor;
    public int $isInactive;
    public ?int $abstractWordCount;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->sectionId = (int) ($row["section_id"] ?? 0);
        $this->journalId = (int) ($row["journal_id"] ?? 0);
        $this->reviewFormId = isset($row["review_form_id"]) ? (int) $row["review_form_id"] : null;
        $this->seq = (float) ($row["seq"] ?? 0);
        $this->editorRestricted = (int) ($row["editor_restricted"] ?? 0);
        $this->metaIndexed = (int) ($row["meta_indexed"] ?? 0);
        $this->metaReviewed = (int) ($row["meta_reviewed"] ?? 1);
        $this->abstractsNotRequired = (int) ($row["abstracts_not_required"] ?? 0);
        $this->hideTitle = (int) ($row["hide_title"] ?? 0);
        $this->hideAuthor = (int) ($row["hide_author"] ?? 0);
        $this->isInactive = (int) ($row["is_inactive"] ?? 0);
        $this->abstractWordCount = isset($row["abstract_word_count"]) ? (int) $row["abstract_word_count"] : null;
    }
}