<?php

declare(strict_types=1);

namespace OJS\Tests\IssueGalleySettings;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\IssueGalleySettings\{ IssueGalleySettingsDto, IssueGalleySettingsModel, IIssueGalleySettingsService, IssueGalleySettingsService };

class IssueGalleySettingsServiceTest extends TestCase
{
    private MockObject $repository;
    private array $input;
    private IssueGalleySettingsDto $dto;
    private IssueGalleySettingsModel $model;
    private IIssueGalleySettingsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("OJS\IssueGalleySettings\IIssueGalleySettingsRepository");
        $this->input = [
            "issue_galley_setting_id" => 9870,
            "galley_id" => 7712,
            "locale" => "Series region tell analysis right standard goal. College close environmental list. Like push same series.",
            "setting_name" => "Attention three seem list but. Treatment identify eye assume raise candidate.",
            "setting_value" => "Ago floor development some either discuss ever court. Deal before own recently who. Theory kitchen draw magazine.",
            "setting_type" => "Hot present least stand former. Check chance something ability recent language organization meet.",
        ];
        $this->dto = new IssueGalleySettingsDto($this->input);
        $this->model = new IssueGalleySettingsModel($this->dto);
        $this->service = new IssueGalleySettingsService($this->repository);
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
        $expected = 5778;

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
        $expected = 1816;

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
        $galleyId = 7027;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($galleyId)
            ->willReturn(null);

        $actual = $this->service->get($galleyId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $galleyId = 1849;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($galleyId)
            ->willReturn($this->dto);

        $actual = $this->service->get($galleyId);
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
        $galleyId = 5836;
        $expected = 9346;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($galleyId)
            ->willReturn($expected);

        $actual = $this->service->delete($galleyId);
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