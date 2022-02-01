<?php

declare(strict_types=1);

namespace OJS\Tests\Subscriptions;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Subscriptions\{ SubscriptionsDto, SubscriptionsModel, ISubscriptionsService, SubscriptionsService };

class SubscriptionsServiceTest extends TestCase
{
    private MockObject $repository;
    private array $input;
    private SubscriptionsDto $dto;
    private SubscriptionsModel $model;
    private ISubscriptionsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("OJS\Subscriptions\ISubscriptionsRepository");
        $this->input = [
            "subscription_id" => 2713,
            "journal_id" => 6650,
            "user_id" => 3836,
            "type_id" => 8651,
            "date_start" => "2022-02-03",
            "date_end" => "2022-02-26",
            "status" => 8945,
            "membership" => "Then table occur her charge. Key listen field heavy. Tax scene song teacher. Everything risk night sister opportunity.",
            "reference_number" => "Against manage cost decide may prove two. Prove parent sing magazine dog explain new.",
            "notes" => "Science production about area student cover capital. Program message computer future give tend seem also.",
        ];
        $this->dto = new SubscriptionsDto($this->input);
        $this->model = new SubscriptionsModel($this->dto);
        $this->service = new SubscriptionsService($this->repository);
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
        $expected = 9331;

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
        $expected = 7579;

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
        $subscriptionId = 2254;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($subscriptionId)
            ->willReturn(null);

        $actual = $this->service->get($subscriptionId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $subscriptionId = 746;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($subscriptionId)
            ->willReturn($this->dto);

        $actual = $this->service->get($subscriptionId);
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
        $subscriptionId = 7801;
        $expected = 3457;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($subscriptionId)
            ->willReturn($expected);

        $actual = $this->service->delete($subscriptionId);
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