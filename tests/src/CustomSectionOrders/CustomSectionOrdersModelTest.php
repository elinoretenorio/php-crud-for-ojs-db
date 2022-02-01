<?php

declare(strict_types=1);

namespace OJS\Tests\CustomSectionOrders;

use PHPUnit\Framework\TestCase;
use OJS\CustomSectionOrders\{ CustomSectionOrdersDto, CustomSectionOrdersModel };

class CustomSectionOrdersModelTest extends TestCase
{
    private array $input;
    private CustomSectionOrdersDto $dto;
    private CustomSectionOrdersModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "custom_section_order_id" => 1195,
            "issue_id" => 7466,
            "section_id" => 7597,
            "seq" => 92.00,
        ];
        $this->dto = new CustomSectionOrdersDto($this->input);
        $this->model = new CustomSectionOrdersModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new CustomSectionOrdersModel(null);

        $this->assertInstanceOf(CustomSectionOrdersModel::class, $model);
    }

    public function testGetCustomSectionOrderId(): void
    {
        $this->assertEquals($this->dto->customSectionOrderId, $this->model->getCustomSectionOrderId());
    }

    public function testSetCustomSectionOrderId(): void
    {
        $expected = 7820;
        $model = $this->model;
        $model->setCustomSectionOrderId($expected);

        $this->assertEquals($expected, $model->getCustomSectionOrderId());
    }

    public function testGetIssueId(): void
    {
        $this->assertEquals($this->dto->issueId, $this->model->getIssueId());
    }

    public function testSetIssueId(): void
    {
        $expected = 3975;
        $model = $this->model;
        $model->setIssueId($expected);

        $this->assertEquals($expected, $model->getIssueId());
    }

    public function testGetSectionId(): void
    {
        $this->assertEquals($this->dto->sectionId, $this->model->getSectionId());
    }

    public function testSetSectionId(): void
    {
        $expected = 6469;
        $model = $this->model;
        $model->setSectionId($expected);

        $this->assertEquals($expected, $model->getSectionId());
    }

    public function testGetSeq(): void
    {
        $this->assertEquals($this->dto->seq, $this->model->getSeq());
    }

    public function testSetSeq(): void
    {
        $expected = 921.37;
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