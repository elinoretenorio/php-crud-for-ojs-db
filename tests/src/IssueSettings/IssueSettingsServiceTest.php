<?php

declare(strict_types=1);

namespace OJS\Tests\IssueSettings;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\IssueSettings\{ IssueSettingsDto, IssueSettingsModel, IIssueSettingsService, IssueSettingsService };

class IssueSettingsServiceTest extends TestCase
{
    private MockObject $repository;
    private array $input;
    private IssueSettingsDto $dto;
    private IssueSettingsModel $model;
    private IIssueSettingsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("OJS\IssueSettings\IIssueSettingsRepository");
        $this->input = [
            "issue_setting_id" => 6386,
            "issue_id" => 7362,
            "locale" => "Need drive line goal thousand send. Least our yard industry owner mission.",
            "setting_name" => "Window management voice ready. Real compare collection source coach add.",
            "setting_value" => "Suffer close wide question check war. Any everything according bag control admit simple. Lead couple investment agency plant.",
            "setting_type" => "Child town issue remain high kind institution. Design real list go you. Near on production.",
        ];
        $this->dto = new IssueSettingsDto($this->input);
        $this->model = new IssueSettingsModel($this->dto);
        $this->service = new IssueSettingsService($this->repository);
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
        $expected = 8356;

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
        $expected = 8565;

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
        $issueSettingId = 5505;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($issueSettingId)
            ->willReturn(null);

        $actual = $this->service->get($issueSettingId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $issueSettingId = 8972;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($issueSettingId)
            ->willReturn($this->dto);

        $actual = $this->service->get($issueSettingId);
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
        $issueSettingId = 8674;
        $expected = 1772;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($issueSettingId)
            ->willReturn($expected);

        $actual = $this->service->delete($issueSettingId);
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