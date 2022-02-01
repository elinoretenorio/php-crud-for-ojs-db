<?php

declare(strict_types=1);

namespace OJS\Tests\Journals;

use PHPUnit\Framework\TestCase;
use OJS\Journals\{ JournalsDto, JournalsModel };

class JournalsModelTest extends TestCase
{
    private array $input;
    private JournalsDto $dto;
    private JournalsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "journal_id" => 1418,
            "path" => "Follow most training notice. Against technology surface environment be. Girl such just peace though another policy.",
            "seq" => 486.67,
            "primary_locale" => "Low board name happen president. Air message bar politics reveal prepare. Game expect field pass.",
            "enabled" => 4955,
            "current_issue_id" => 9546,
        ];
        $this->dto = new JournalsDto($this->input);
        $this->model = new JournalsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new JournalsModel(null);

        $this->assertInstanceOf(JournalsModel::class, $model);
    }

    public function testGetJournalId(): void
    {
        $this->assertEquals($this->dto->journalId, $this->model->getJournalId());
    }

    public function testSetJournalId(): void
    {
        $expected = 2483;
        $model = $this->model;
        $model->setJournalId($expected);

        $this->assertEquals($expected, $model->getJournalId());
    }

    public function testGetPath(): void
    {
        $this->assertEquals($this->dto->path, $this->model->getPath());
    }

    public function testSetPath(): void
    {
        $expected = "Great represent this concern return four. Her rather customer of. Save of college case president author somebody.";
        $model = $this->model;
        $model->setPath($expected);

        $this->assertEquals($expected, $model->getPath());
    }

    public function testGetSeq(): void
    {
        $this->assertEquals($this->dto->seq, $this->model->getSeq());
    }

    public function testSetSeq(): void
    {
        $expected = 829.64;
        $model = $this->model;
        $model->setSeq($expected);

        $this->assertEquals($expected, $model->getSeq());
    }

    public function testGetPrimaryLocale(): void
    {
        $this->assertEquals($this->dto->primaryLocale, $this->model->getPrimaryLocale());
    }

    public function testSetPrimaryLocale(): void
    {
        $expected = "Explain tree degree blue. Dark win meeting collection ago despite friend. Most likely dark attack safe hit drive.";
        $model = $this->model;
        $model->setPrimaryLocale($expected);

        $this->assertEquals($expected, $model->getPrimaryLocale());
    }

    public function testGetEnabled(): void
    {
        $this->assertEquals($this->dto->enabled, $this->model->getEnabled());
    }

    public function testSetEnabled(): void
    {
        $expected = 7854;
        $model = $this->model;
        $model->setEnabled($expected);

        $this->assertEquals($expected, $model->getEnabled());
    }

    public function testGetCurrentIssueId(): void
    {
        $this->assertEquals($this->dto->currentIssueId, $this->model->getCurrentIssueId());
    }

    public function testSetCurrentIssueId(): void
    {
        $expected = 5678;
        $model = $this->model;
        $model->setCurrentIssueId($expected);

        $this->assertEquals($expected, $model->getCurrentIssueId());
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