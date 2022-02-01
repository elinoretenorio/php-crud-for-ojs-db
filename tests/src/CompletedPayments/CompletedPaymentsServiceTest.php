<?php

declare(strict_types=1);

namespace OJS\Tests\CompletedPayments;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\CompletedPayments\{ CompletedPaymentsDto, CompletedPaymentsModel, ICompletedPaymentsService, CompletedPaymentsService };

class CompletedPaymentsServiceTest extends TestCase
{
    private MockObject $repository;
    private array $input;
    private CompletedPaymentsDto $dto;
    private CompletedPaymentsModel $model;
    private ICompletedPaymentsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("OJS\CompletedPayments\ICompletedPaymentsRepository");
        $this->input = [
            "completed_payment_id" => 4467,
            "timestamp" => "2022-02-10",
            "payment_type" => 8291,
            "context_id" => 6214,
            "user_id" => 674,
            "assoc_id" => 3974,
            "amount" => 617.60,
            "currency_code_alpha" => "Force guy charge get range crime science. Others ability difference large perhaps.",
            "payment_method_plugin_name" => "He soon manager race young task pressure. Loss administration television rich might. State cause director since thing.",
        ];
        $this->dto = new CompletedPaymentsDto($this->input);
        $this->model = new CompletedPaymentsModel($this->dto);
        $this->service = new CompletedPaymentsService($this->repository);
    }

    protected function tearDown(): void
    {
        unset($this->repository);
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 5242;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEmpty($actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 5542;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsNull(): void
    {
        $completedPaymentId = 7666;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($completedPaymentId)
            ->willReturn(null);

        $actual = $this->service->get($completedPaymentId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $completedPaymentId = 131;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($completedPaymentId)
            ->willReturn($this->dto);

        $actual = $this->service->get($completedPaymentId);
        $this->assertEquals($this->model, $actual);
    }

    public function testGetAll_ReturnsEmpty(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([]);

        $actual = $this->service->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsModels(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->dto]);

        $actual = $this->service->getAll();
        $this->assertEquals([$this->model], $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $completedPaymentId = 9415;
        $expected = 2272;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($completedPaymentId)
            ->willReturn($expected);

        $actual = $this->service->delete($completedPaymentId);
        $this->assertEquals($expected, $actual);
    }

    public function testCreateModel_ReturnsNullIfEmpty(): void
    {
        $actual = $this->service->createModel([]);
        $this->assertNull($actual);
    }

    public function testCreateModel_ReturnsModel(): void
    {
        $actual = $this->service->createModel($this->input);
        $this->assertEquals($this->model, $actual);
    }
}