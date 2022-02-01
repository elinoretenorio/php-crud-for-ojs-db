<?php

declare(strict_types=1);

namespace OJS\Tests\QueuedPayments;

use PHPUnit\Framework\TestCase;
use OJS\QueuedPayments\{ QueuedPaymentsDto, QueuedPaymentsModel };

class QueuedPaymentsModelTest extends TestCase
{
    private array $input;
    private QueuedPaymentsDto $dto;
    private QueuedPaymentsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "queued_payment_id" => 4143,
            "date_created" => "2022-02-14",
            "date_modified" => "2022-02-03",
            "expiry_date" => "2022-02-21",
            "payment_data" => "Cover seven great campaign front. Soldier stage modern both career finally green. Race instead art large government.",
        ];
        $this->dto = new QueuedPaymentsDto($this->input);
        $this->model = new QueuedPaymentsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new QueuedPaymentsModel(null);

        $this->assertInstanceOf(QueuedPaymentsModel::class, $model);
    }

    public function testGetQueuedPaymentId(): void
    {
        $this->assertEquals($this->dto->queuedPaymentId, $this->model->getQueuedPaymentId());
    }

    public function testSetQueuedPaymentId(): void
    {
        $expected = 5950;
        $model = $this->model;
        $model->setQueuedPaymentId($expected);

        $this->assertEquals($expected, $model->getQueuedPaymentId());
    }

    public function testGetDateCreated(): void
    {
        $this->assertEquals($this->dto->dateCreated, $this->model->getDateCreated());
    }

    public function testSetDateCreated(): void
    {
        $expected = "2022-02-13";
        $model = $this->model;
        $model->setDateCreated($expected);

        $this->assertEquals($expected, $model->getDateCreated());
    }

    public function testGetDateModified(): void
    {
        $this->assertEquals($this->dto->dateModified, $this->model->getDateModified());
    }

    public function testSetDateModified(): void
    {
        $expected = "2022-03-01";
        $model = $this->model;
        $model->setDateModified($expected);

        $this->assertEquals($expected, $model->getDateModified());
    }

    public function testGetExpiryDate(): void
    {
        $this->assertEquals($this->dto->expiryDate, $this->model->getExpiryDate());
    }

    public function testSetExpiryDate(): void
    {
        $expected = "2022-02-06";
        $model = $this->model;
        $model->setExpiryDate($expected);

        $this->assertEquals($expected, $model->getExpiryDate());
    }

    public function testGetPaymentData(): void
    {
        $this->assertEquals($this->dto->paymentData, $this->model->getPaymentData());
    }

    public function testSetPaymentData(): void
    {
        $expected = "Involve collection think wonder really before dream. Machine sea option military media seven question.";
        $model = $this->model;
        $model->setPaymentData($expected);

        $this->assertEquals($expected, $model->getPaymentData());
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