<?php

declare(strict_types=1);

namespace OJS\Tests\CustomIssueOrders;

use PHPUnit\Framework\TestCase;
use OJS\CustomIssueOrders\{ CustomIssueOrdersDto, CustomIssueOrdersModel };

class CustomIssueOrdersModelTest extends TestCase
{
    private array $input;
    private CustomIssueOrdersDto $dto;
    private CustomIssueOrdersModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "custom_issue_order_id" => 3003,
            "issue_id" => 851,
            "journal_id" => 3166,
            "seq" => 318.14,
        ];
        $this->dto = new CustomIssueOrdersDto($this->input);
        $this->model = new CustomIssueOrdersModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new CustomIssueOrdersModel(null);

        $this->assertInstanceOf(CustomIssueOrdersModel::class, $model);
    }

    public function testGetCustomIssueOrderId(): void
    {
        $this->assertEquals($this->dto->customIssueOrderId, $this->model->getCustomIssueOrderId());
    }

    public function testSetCustomIssueOrderId(): void
    {
        $expected = 506;
        $model = $this->model;
        $model->setCustomIssueOrderId($expected);

        $this->assertEquals($expected, $model->getCustomIssueOrderId());
    }

    public function testGetIssueId(): void
    {
        $this->assertEquals($this->dto->issueId, $this->model->getIssueId());
    }

    public function testSetIssueId(): void
    {
        $expected = 9786;
        $model = $this->model;
        $model->setIssueId($expected);

        $this->assertEquals($expected, $model->getIssueId());
    }

    public function testGetJournalId(): void
    {
        $this->assertEquals($this->dto->journalId, $this->model->getJournalId());
    }

    public function testSetJournalId(): void
    {
        $expected = 5975;
        $model = $this->model;
        $model->setJournalId($expected);

        $this->assertEquals($expected, $model->getJournalId());
    }

    public function testGetSeq(): void
    {
        $this->assertEquals($this->dto->seq, $this->model->getSeq());
    }

    public function testSetSeq(): void
    {
        $expected = 686.44;
        $model = $this->model;
        $model->setSeq($expected);

        $this->assertEquals($expected, $model->getSeq());
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