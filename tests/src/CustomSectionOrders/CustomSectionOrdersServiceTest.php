<?php

declare(strict_types=1);

namespace OJS\Tests\CustomSectionOrders;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\CustomSectionOrders\{ CustomSectionOrdersDto, CustomSectionOrdersModel, ICustomSectionOrdersService, CustomSectionOrdersService };

class CustomSectionOrdersServiceTest extends TestCase
{
    private MockObject $repository;
    private array $input;
    private CustomSectionOrdersDto $dto;
    private CustomSectionOrdersModel $model;
    private ICustomSectionOrdersService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("OJS\CustomSectionOrders\ICustomSectionOrdersRepository");
        $this->input = [
            "custom_section_order_id" => 8405,
            "issue_id" => 348,
            "section_id" => 6459,
            "seq" => 337.00,
        ];
        $this->dto = new CustomSectionOrdersDto($this->input);
        $this->model = new CustomSectionOrdersModel($this->dto);
        $this->service = new CustomSectionOrdersService($this->repository);
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
        $expected = 4050;

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
        $expected = 6435;

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
        $customSectionOrderId = 5391;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($customSectionOrderId)
            ->willReturn(null);

        $actual = $this->service->get($customSectionOrderId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $customSectionOrderId = 9559;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($customSectionOrderId)
            ->willReturn($this->dto);

        $actual = $this->service->get($customSectionOrderId);
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
        $customSectionOrderId = 650;
        $expected = 976;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($customSectionOrderId)
            ->willReturn($expected);

        $actual = $this->service->delete($customSectionOrderId);
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