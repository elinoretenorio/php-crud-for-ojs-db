<?php

declare(strict_types=1);

namespace OJS\Tests\JournalSettings;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\JournalSettings\{ JournalSettingsDto, JournalSettingsModel, IJournalSettingsService, JournalSettingsService };

class JournalSettingsServiceTest extends TestCase
{
    private MockObject $repository;
    private array $input;
    private JournalSettingsDto $dto;
    private JournalSettingsModel $model;
    private IJournalSettingsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("OJS\JournalSettings\IJournalSettingsRepository");
        $this->input = [
            "journal_setting_id" => 6097,
            "journal_id" => 9511,
            "locale" => "Economy sea see its into. Weight capital game pass shake. Girl strategy interview test. Dinner let right same speech remain.",
            "setting_name" => "South would certain prepare city. Opportunity risk myself key democratic each. Sound increase meet attack suggest long Democrat.",
            "setting_value" => "Specific child down behavior economic my she. Step significant time wind add.",
            "setting_type" => "Congress discussion check. Result painting team despite.",
        ];
        $this->dto = new JournalSettingsDto($this->input);
        $this->model = new JournalSettingsModel($this->dto);
        $this->service = new JournalSettingsService($this->repository);
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
        $expected = 4935;

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
        $expected = 7387;

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
        $journalSettingId = 4862;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($journalSettingId)
            ->willReturn(null);

        $actual = $this->service->get($journalSettingId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $journalSettingId = 5204;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($journalSettingId)
            ->willReturn($this->dto);

        $actual = $this->service->get($journalSettingId);
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
        $journalSettingId = 8285;
        $expected = 910;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($journalSettingId)
            ->willReturn($expected);

        $actual = $this->service->delete($journalSettingId);
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