<?php

declare(strict_types=1);

namespace OJS\Tests\InstitutionalSubscriptions;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\InstitutionalSubscriptions\{ InstitutionalSubscriptionsDto, InstitutionalSubscriptionsModel, IInstitutionalSubscriptionsService, InstitutionalSubscriptionsService };

class InstitutionalSubscriptionsServiceTest extends TestCase
{
    private MockObject $repository;
    private array $input;
    private InstitutionalSubscriptionsDto $dto;
    private InstitutionalSubscriptionsModel $model;
    private IInstitutionalSubscriptionsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("OJS\InstitutionalSubscriptions\IInstitutionalSubscriptionsRepository");
        $this->input = [
            "institutional_subscription_id" => 7760,
            "subscription_id" => 5787,
            "institution_name" => "Work important so use whether standard. Course compare board participant magazine. Pressure strong face she bit read.",
            "mailing_address" => "Successful although series first such capital door. Now positive heavy trial guess TV.",
            "domain" => "Through language top either.",
        ];
        $this->dto = new InstitutionalSubscriptionsDto($this->input);
        $this->model = new InstitutionalSubscriptionsModel($this->dto);
        $this->service = new InstitutionalSubscriptionsService($this->repository);
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
        $expected = 9649;

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
        $expected = 4707;

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
        $institutionalSubscriptionId = 3266;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($institutionalSubscriptionId)
            ->willReturn(null);

        $actual = $this->service->get($institutionalSubscriptionId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $institutionalSubscriptionId = 9818;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($institutionalSubscriptionId)
            ->willReturn($this->dto);

        $actual = $this->service->get($institutionalSubscriptionId);
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
        $institutionalSubscriptionId = 5160;
        $expected = 4656;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($institutionalSubscriptionId)
            ->willReturn($expected);

        $actual = $this->service->delete($institutionalSubscriptionId);
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