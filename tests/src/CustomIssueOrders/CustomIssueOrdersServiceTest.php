<?php

declare(strict_types=1);

namespace OJS\Tests\CustomIssueOrders;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\CustomIssueOrders\{ CustomIssueOrdersDto, CustomIssueOrdersModel, ICustomIssueOrdersService, CustomIssueOrdersService };

class CustomIssueOrdersServiceTest extends TestCase
{
    private MockObject $repository;
    private array $input;
    private CustomIssueOrdersDto $dto;
    private CustomIssueOrdersModel $model;
    private ICustomIssueOrdersService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("OJS\CustomIssueOrders\ICustomIssueOrdersRepository");
        $this->input = [
            "custom_issue_order_id" => 9444,
            "issue_id" => 6083,
            "journal_id" => 3862,
            "seq" => 751.00,
        ];
        $this->dto = new CustomIssueOrdersDto($this->input);
        $this->model = new CustomIssueOrdersModel($this->dto);
        $this->service = new CustomIssueOrdersService($this->repository);
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
        $expected = 7931;

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
        $expected = 892;

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
        $customIssueOrderId = 8027;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($customIssueOrderId)
            ->willReturn(null);

        $actual = $this->service->get($customIssueOrderId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $customIssueOrderId = 8825;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($customIssueOrderId)
            ->willReturn($this->dto);

        $actual = $this->service->get($customIssueOrderId);
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
        $customIssueOrderId = 3221;
        $expected = 6082;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($customIssueOrderId)
            ->willReturn($expected);

        $actual = $this->service->delete($customIssueOrderId);
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