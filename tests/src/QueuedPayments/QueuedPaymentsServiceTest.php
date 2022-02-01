<?php

declare(strict_types=1);

namespace OJS\Tests\QueuedPayments;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\QueuedPayments\{ QueuedPaymentsDto, QueuedPaymentsModel, IQueuedPaymentsService, QueuedPaymentsService };

class QueuedPaymentsServiceTest extends TestCase
{
    private MockObject $repository;
    private array $input;
    private QueuedPaymentsDto $dto;
    private QueuedPaymentsModel $model;
    private IQueuedPaymentsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("OJS\QueuedPayments\IQueuedPaymentsRepository");
        $this->input = [
            "queued_payment_id" => 204,
            "date_created" => "2022-02-20",
            "date_modified" => "2022-02-22",
            "expiry_date" => "2022-02-25",
            "payment_data" => "Responsibility situation pull significant.",
        ];
        $this->dto = new QueuedPaymentsDto($this->input);
        $this->model = new QueuedPaymentsModel($this->dto);
        $this->service = new QueuedPaymentsService($this->repository);
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
        $expected = 8435;

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
        $expected = 666;

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
        $queuedPaymentId = 4568;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($queuedPaymentId)
            ->willReturn(null);

        $actual = $this->service->get($queuedPaymentId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $queuedPaymentId = 937;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($queuedPaymentId)
            ->willReturn($this->dto);

        $actual = $this->service->get($queuedPaymentId);
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
        $queuedPaymentId = 3532;
        $expected = 2798;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($queuedPaymentId)
            ->willReturn($expected);

        $actual = $this->service->delete($queuedPaymentId);
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