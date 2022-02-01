<?php

declare(strict_types=1);

namespace OJS\Tests\CompletedPayments;

use PHPUnit\Framework\TestCase;
use OJS\CompletedPayments\{ CompletedPaymentsDto, CompletedPaymentsModel };

class CompletedPaymentsModelTest extends TestCase
{
    private array $input;
    private CompletedPaymentsDto $dto;
    private CompletedPaymentsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "completed_payment_id" => 5277,
            "timestamp" => "2022-02-10",
            "payment_type" => 1077,
            "context_id" => 6975,
            "user_id" => 6894,
            "assoc_id" => 4753,
            "amount" => 804.27,
            "currency_code_alpha" => "Color south remain imagine reason. Week thus offer seem contain around beautiful herself.",
            "payment_method_plugin_name" => "Way fill happen while walk assume tonight husband. Network speak realize sport owner.",
        ];
        $this->dto = new CompletedPaymentsDto($this->input);
        $this->model = new CompletedPaymentsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new CompletedPaymentsModel(null);

        $this->assertInstanceOf(CompletedPaymentsModel::class, $model);
    }

    public function testGetCompletedPaymentId(): void
    {
        $this->assertEquals($this->dto->completedPaymentId, $this->model->getCompletedPaymentId());
    }

    public function testSetCompletedPaymentId(): void
    {
        $expected = 8099;
        $model = $this->model;
        $model->setCompletedPaymentId($expected);

        $this->assertEquals($expected, $model->getCompletedPaymentId());
    }

    public function testGetTimestamp(): void
    {
        $this->assertEquals($this->dto->timestamp, $this->model->getTimestamp());
    }

    public function testSetTimestamp(): void
    {
        $expected = "2022-02-25";
        $model = $this->model;
        $model->setTimestamp($expected);

        $this->assertEquals($expected, $model->getTimestamp());
    }

    public function testGetPaymentType(): void
    {
        $this->assertEquals($this->dto->paymentType, $this->model->getPaymentType());
    }

    public function testSetPaymentType(): void
    {
        $expected = 6101;
        $model = $this->model;
        $model->setPaymentType($expected);

        $this->assertEquals($expected, $model->getPaymentType());
    }

    public function testGetContextId(): void
    {
        $this->assertEquals($this->dto->contextId, $this->model->getContextId());
    }

    public function testSetContextId(): void
    {
        $expected = 1225;
        $model = $this->model;
        $model->setContextId($expected);

        $this->assertEquals($expected, $model->getContextId());
    }

    public function testGetUserId(): void
    {
        $this->assertEquals($this->dto->userId, $this->model->getUserId());
    }

    public function testSetUserId(): void
    {
        $expected = 4103;
        $model = $this->model;
        $model->setUserId($expected);

        $this->assertEquals($expected, $model->getUserId());
    }

    public function testGetAssocId(): void
    {
        $this->assertEquals($this->dto->assocId, $this->model->getAssocId());
    }

    public function testSetAssocId(): void
    {
        $expected = 9835;
        $model = $this->model;
        $model->setAssocId($expected);

        $this->assertEquals($expected, $model->getAssocId());
    }

    public function testGetAmount(): void
    {
        $this->assertEquals($this->dto->amount, $this->model->getAmount());
    }

    public function testSetAmount(): void
    {
        $expected = 243.18;
        $model = $this->model;
        $model->setAmount($expected);

        $this->assertEquals($expected, $model->getAmount());
    }

    public function testGetCurrencyCodeAlpha(): void
    {
        $this->assertEquals($this->dto->currencyCodeAlpha, $this->model->getCurrencyCodeAlpha());
    }

    public function testSetCurrencyCodeAlpha(): void
    {
        $expected = "Loss media few teacher. Rise agency play wear.";
        $model = $this->model;
        $model->setCurrencyCodeAlpha($expected);

        $this->assertEquals($expected, $model->getCurrencyCodeAlpha());
    }

    public function testGetPaymentMethodPluginName(): void
    {
        $this->assertEquals($this->dto->paymentMethodPluginName, $this->model->getPaymentMethodPluginName());
    }

    public function testSetPaymentMethodPluginName(): void
    {
        $expected = "Like play just night. Seem term pick director church. North shake economy can drug way them. Could century as oil.";
        $model = $this->model;
        $model->setPaymentMethodPluginName($expected);

        $this->assertEquals($expected, $model->getPaymentMethodPluginName());
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