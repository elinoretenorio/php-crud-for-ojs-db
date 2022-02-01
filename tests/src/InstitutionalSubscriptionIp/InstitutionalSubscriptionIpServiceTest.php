<?php

declare(strict_types=1);

namespace OJS\Tests\InstitutionalSubscriptionIp;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\InstitutionalSubscriptionIp\{ InstitutionalSubscriptionIpDto, InstitutionalSubscriptionIpModel, IInstitutionalSubscriptionIpService, InstitutionalSubscriptionIpService };

class InstitutionalSubscriptionIpServiceTest extends TestCase
{
    private MockObject $repository;
    private array $input;
    private InstitutionalSubscriptionIpDto $dto;
    private InstitutionalSubscriptionIpModel $model;
    private IInstitutionalSubscriptionIpService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("OJS\InstitutionalSubscriptionIp\IInstitutionalSubscriptionIpRepository");
        $this->input = [
            "institutional_subscription_ip_id" => 8171,
            "subscription_id" => 6038,
            "ip_string" => "System from theory case. Though again court leave they his.",
            "ip_start" => 8821,
            "ip_end" => 5196,
        ];
        $this->dto = new InstitutionalSubscriptionIpDto($this->input);
        $this->model = new InstitutionalSubscriptionIpModel($this->dto);
        $this->service = new InstitutionalSubscriptionIpService($this->repository);
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
        $expected = 5237;

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
        $expected = 7001;

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
        $institutionalSubscriptionIpId = 2252;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($institutionalSubscriptionIpId)
            ->willReturn(null);

        $actual = $this->service->get($institutionalSubscriptionIpId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $institutionalSubscriptionIpId = 6898;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($institutionalSubscriptionIpId)
            ->willReturn($this->dto);

        $actual = $this->service->get($institutionalSubscriptionIpId);
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
        $institutionalSubscriptionIpId = 7734;
        $expected = 4532;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($institutionalSubscriptionIpId)
            ->willReturn($expected);

        $actual = $this->service->delete($institutionalSubscriptionIpId);
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