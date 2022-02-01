<?php

declare(strict_types=1);

namespace OJS\Tests\Sections;

use PHPUnit\Framework\TestCase;
use OJS\Sections\{ SectionsDto, SectionsModel };

class SectionsModelTest extends TestCase
{
    private array $input;
    private SectionsDto $dto;
    private SectionsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "section_id" => 2381,
            "journal_id" => 5320,
            "review_form_id" => 5830,
            "seq" => 825.51,
            "editor_restricted" => 3736,
            "meta_indexed" => 2459,
            "meta_reviewed" => 4035,
            "abstracts_not_required" => 4102,
            "hide_title" => 7731,
            "hide_author" => 3494,
            "is_inactive" => 8621,
            "abstract_word_count" => 465,
        ];
        $this->dto = new SectionsDto($this->input);
        $this->model = new SectionsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new SectionsModel(null);

        $this->assertInstanceOf(SectionsModel::class, $model);
    }

    public function testGetSectionId(): void
    {
        $this->assertEquals($this->dto->sectionId, $this->model->getSectionId());
    }

    public function testSetSectionId(): void
    {
        $expected = 5770;
        $model = $this->model;
        $model->setSectionId($expected);

        $this->assertEquals($expected, $model->getSectionId());
    }

    public function testGetJournalId(): void
    {
        $this->assertEquals($this->dto->journalId, $this->model->getJournalId());
    }

    public function testSetJournalId(): void
    {
        $expected = 5684;
        $model = $this->model;
        $model->setJournalId($expected);

        $this->assertEquals($expected, $model->getJournalId());
    }

    public function testGetReviewFormId(): void
    {
        $this->assertEquals($this->dto->reviewFormId, $this->model->getReviewFormId());
    }

    public function testSetReviewFormId(): void
    {
        $expected = 1727;
        $model = $this->model;
        $model->setReviewFormId($expected);

        $this->assertEquals($expected, $model->getReviewFormId());
    }

    public function testGetSeq(): void
    {
        $this->assertEquals($this->dto->seq, $this->model->getSeq());
    }

    public function testSetSeq(): void
    {
        $expected = 628.00;
        $model = $this->model;
        $model->setSeq($expected);

        $this->assertEquals($expected, $model->getSeq());
    }

    public function testGetEditorRestricted(): void
    {
        $this->assertEquals($this->dto->editorRestricted, $this->model->getEditorRestricted());
    }

    public function testSetEditorRestricted(): void
    {
        $expected = 7087;
        $model = $this->model;
        $model->setEditorRestricted($expected);

        $this->assertEquals($expected, $model->getEditorRestricted());
    }

    public function testGetMetaIndexed(): void
    {
        $this->assertEquals($this->dto->metaIndexed, $this->model->getMetaIndexed());
    }

    public function testSetMetaIndexed(): void
    {
        $expected = 1374;
        $model = $this->model;
        $model->setMetaIndexed($expected);

        $this->assertEquals($expected, $model->getMetaIndexed());
    }

    public function testGetMetaReviewed(): void
    {
        $this->assertEquals($this->dto->metaReviewed, $this->model->getMetaReviewed());
    }

    public function testSetMetaReviewed(): void
    {
        $expected = 7463;
        $model = $this->model;
        $model->setMetaReviewed($expected);

        $this->assertEquals($expected, $model->getMetaReviewed());
    }

    public function testGetAbstractsNotRequired(): void
    {
        $this->assertEquals($this->dto->abstractsNotRequired, $this->model->getAbstractsNotRequired());
    }

    public function testSetAbstractsNotRequired(): void
    {
        $expected = 3426;
        $model = $this->model;
        $model->setAbstractsNotRequired($expected);

        $this->assertEquals($expected, $model->getAbstractsNotRequired());
    }

    public function testGetHideTitle(): void
    {
        $this->assertEquals($this->dto->hideTitle, $this->model->getHideTitle());
    }

    public function testSetHideTitle(): void
    {
        $expected = 836;
        $model = $this->model;
        $model->setHideTitle($expected);

        $this->assertEquals($expected, $model->getHideTitle());
    }

    public function testGetHideAuthor(): void
    {
        $this->assertEquals($this->dto->hideAuthor, $this->model->getHideAuthor());
    }

    public function testSetHideAuthor(): void
    {
        $expected = 5299;
        $model = $this->model;
        $model->setHideAuthor($expected);

        $this->assertEquals($expected, $model->getHideAuthor());
    }

    public function testGetIsInactive(): void
    {
        $this->assertEquals($this->dto->isInactive, $this->model->getIsInactive());
    }

    public function testSetIsInactive(): void
    {
        $expected = 7394;
        $model = $this->model;
        $model->setIsInactive($expected);

        $this->assertEquals($expected, $model->getIsInactive());
    }

    public function testGetAbstractWordCount(): void
    {
        $this->assertEquals($this->dto->abstractWordCount, $this->model->getAbstractWordCount());
    }

    public function testSetAbstractWordCount(): void
    {
        $expected = 7898;
        $model = $this->model;
        $model->setAbstractWordCount($expected);

        $this->assertEquals($expected, $model->getAbstractWordCount());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}