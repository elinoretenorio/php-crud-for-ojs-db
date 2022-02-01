<?php

declare(strict_types=1);

namespace OJS\Tests\SubscriptionTypes;

use PHPUnit\Framework\TestCase;
use OJS\SubscriptionTypes\{ SubscriptionTypesDto, SubscriptionTypesModel };

class SubscriptionTypesModelTest extends TestCase
{
    private array $input;
    private SubscriptionTypesDto $dto;
    private SubscriptionTypesModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "type_id" => 4898,
            "journal_id" => 1742,
            "cost" => 107.00,
            "currency_code_alpha" => "Open free when least. Politics dream analysis individual baby my whose.",
            "duration" => 2135,
            "format" => 4310,
            "institutional" => 2810,
            "membership" => 2708,
            "disable_public_display" => 8636,
            "seq" => 380.00,
        ];
        $this->dto = new SubscriptionTypesDto($this->input);
        $this->model = new SubscriptionTypesModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new SubscriptionTypesModel(null);

        $this->assertInstanceOf(SubscriptionTypesModel::class, $model);
    }

    public function testGetTypeId(): void
    {
        $this->assertEquals($this->dto->typeId, $this->model->getTypeId());
    }

    public function testSetTypeId(): void
    {
        $expected = 8645;
        $model = $this->model;
        $model->setTypeId($expected);

        $this->assertEquals($expected, $model->getTypeId());
    }

    public function testGetJournalId(): void
    {
        $this->assertEquals($this->dto->journalId, $this->model->getJournalId());
    }

    public function testSetJournalId(): void
    {
        $expected = 6883;
        $model = $this->model;
        $model->setJournalId($expected);

        $this->assertEquals($expected, $model->getJournalId());
    }

    public function testGetCost(): void
    {
        $this->assertEquals($this->dto->cost, $this->model->getCost());
    }

    public function testSetCost(): void
    {
        $expected = 642.81;
        $model = $this->model;
        $model->setCost($expected);

        $this->assertEquals($expected, $model->getCost());
    }

    public function testGetCurrencyCodeAlpha(): void
    {
        $this->assertEquals($this->dto->currencyCodeAlpha, $this->model->getCurrencyCodeAlpha());
    }

    public function testSetCurrencyCodeAlpha(): void
    {
        $expected = "About final enjoy manage employee customer just represent. Peace realize argue reveal. Travel compare measure impact describe style few.";
        $model = $this->model;
        $model->setCurrencyCodeAlpha($expected);

        $this->assertEquals($expected, $model->getCurrencyCodeAlpha());
    }

    public function testGetDuration(): void
    {
        $this->assertEquals($this->dto->duration, $this->model->getDuration());
    }

    public function testSetDuration(): void
    {
        $expected = 8895;
        $model = $this->model;
        $model->setDuration($expected);

        $this->assertEquals($expected, $model->getDuration());
    }

    public function testGetFormat(): void
    {
        $this->assertEquals($this->dto->format, $this->model->getFormat());
    }

    public function testSetFormat(): void
    {
        $expected = 4785;
        $model = $this->model;
        $model->setFormat($expected);

        $this->assertEquals($expected, $model->getFormat());
    }

    public function testGetInstitutional(): void
    {
        $this->assertEquals($this->dto->institutional, $this->model->getInstitutional());
    }

    public function testSetInstitutional(): void
    {
        $expected = 7825;
        $model = $this->model;
        $model->setInstitutional($expected);

        $this->assertEquals($expected, $model->getInstitutional());
    }

    public function testGetMembership(): void
    {
        $this->assertEquals($this->dto->membership, $this->model->getMembership());
    }

    public function testSetMembership(): void
    {
        $expected = 8894;
        $model = $this->model;
        $model->setMembership($expected);

        $this->assertEquals($expected, $model->getMembership());
    }

    public function testGetDisablePublicDisplay(): void
    {
        $this->assertEquals($this->dto->disablePublicDisplay, $this->model->getDisablePublicDisplay());
    }

    public function testSetDisablePublicDisplay(): void
    {
        $expected = 6646;
        $model = $this->model;
        $model->setDisablePublicDisplay($expected);

        $this->assertEquals($expected, $model->getDisablePublicDisplay());
    }

    public function testGetSeq(): void
    {
        $this->assertEquals($this->dto->seq, $this->model->getSeq());
    }

    public function testSetSeq(): void
    {
        $expected = 66.00;
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