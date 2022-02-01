<?php

declare(strict_types=1);

namespace OJS\Tests\SectionSettings;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\SectionSettings\{ SectionSettingsDto, SectionSettingsModel, ISectionSettingsService, SectionSettingsService };

class SectionSettingsServiceTest extends TestCase
{
    private MockObject $repository;
    private array $input;
    private SectionSettingsDto $dto;
    private SectionSettingsModel $model;
    private ISectionSettingsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("OJS\SectionSettings\ISectionSettingsRepository");
        $this->input = [
            "section_setting_id" => 8868,
            "section_id" => 329,
            "locale" => "Floor far section entire. Story film red performance. Learn there democratic give base why form large.",
            "setting_name" => "Outside customer buy job rest quality certain chair. Western wait by strong my.",
            "setting_value" => "Tv half direction account shake environment. Region decade statement service. Half strong why.",
            "setting_type" => "Modern religious phone Congress. Quickly sit meet success tell.",
        ];
        $this->dto = new SectionSettingsDto($this->input);
        $this->model = new SectionSettingsModel($this->dto);
        $this->service = new SectionSettingsService($this->repository);
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
        $expected = 9157;

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
        $expected = 5249;

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
        $sectionSettingId = 2991;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($sectionSettingId)
            ->willReturn(null);

        $actual = $this->service->get($sectionSettingId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $sectionSettingId = 505;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($sectionSettingId)
            ->willReturn($this->dto);

        $actual = $this->service->get($sectionSettingId);
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
        $sectionSettingId = 3942;
        $expected = 1477;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($sectionSettingId)
            ->willReturn($expected);

        $actual = $this->service->delete($sectionSettingId);
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