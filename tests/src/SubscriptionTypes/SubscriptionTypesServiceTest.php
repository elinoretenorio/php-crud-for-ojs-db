<?php

declare(strict_types=1);

namespace OJS\Tests\SubscriptionTypes;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\SubscriptionTypes\{ SubscriptionTypesDto, SubscriptionTypesModel, ISubscriptionTypesService, SubscriptionTypesService };

class SubscriptionTypesServiceTest extends TestCase
{
    private MockObject $repository;
    private array $input;
    private SubscriptionTypesDto $dto;
    private SubscriptionTypesModel $model;
    private ISubscriptionTypesService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("OJS\SubscriptionTypes\ISubscriptionTypesRepository");
        $this->input = [
            "type_id" => 2927,
            "journal_id" => 3038,
            "cost" => 535.00,
            "currency_code_alpha" => "Above message detail doctor spring very station. Himself important several later opportunity here.",
            "duration" => 3318,
            "format" => 973,
            "institutional" => 2783,
            "membership" => 336,
            "disable_public_display" => 9690,
            "seq" => 931.31,
        ];
        $this->dto = new SubscriptionTypesDto($this->input);
        $this->model = new SubscriptionTypesModel($this->dto);
        $this->service = new SubscriptionTypesService($this->repository);
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
        $expected = 4872;

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
        $expected = 3054;

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
        $typeId = 3909;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($typeId)
            ->willReturn(null);

        $actual = $this->service->get($typeId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $typeId = 6126;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($typeId)
            ->willReturn($this->dto);

        $actual = $this->service->get($typeId);
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
        $typeId = 1654;
        $expected = 4766;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($typeId)
            ->willReturn($expected);

        $actual = $this->service->delete($typeId);
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