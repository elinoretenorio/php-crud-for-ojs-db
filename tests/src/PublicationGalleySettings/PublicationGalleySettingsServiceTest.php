<?php

declare(strict_types=1);

namespace OJS\Tests\PublicationGalleySettings;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\PublicationGalleySettings\{ PublicationGalleySettingsDto, PublicationGalleySettingsModel, IPublicationGalleySettingsService, PublicationGalleySettingsService };

class PublicationGalleySettingsServiceTest extends TestCase
{
    private MockObject $repository;
    private array $input;
    private PublicationGalleySettingsDto $dto;
    private PublicationGalleySettingsModel $model;
    private IPublicationGalleySettingsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("OJS\PublicationGalleySettings\IPublicationGalleySettingsRepository");
        $this->input = [
            "publication_galley_setting_id" => 301,
            "galley_id" => 3551,
            "locale" => "Less individual dog participant reality democratic. Pattern talk along even official.",
            "setting_name" => "Common doctor main discuss. Agreement win down friend.",
            "setting_value" => "Protect medical dream current small line. Standard check her southern case. Mr defense physical anything try public.",
        ];
        $this->dto = new PublicationGalleySettingsDto($this->input);
        $this->model = new PublicationGalleySettingsModel($this->dto);
        $this->service = new PublicationGalleySettingsService($this->repository);
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
        $expected = 2606;

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
        $expected = 3913;

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
        $publicationGalleySettingId = 1904;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($publicationGalleySettingId)
            ->willReturn(null);

        $actual = $this->service->get($publicationGalleySettingId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $publicationGalleySettingId = 6273;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($publicationGalleySettingId)
            ->willReturn($this->dto);

        $actual = $this->service->get($publicationGalleySettingId);
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
        $publicationGalleySettingId = 1858;
        $expected = 7471;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($publicationGalleySettingId)
            ->willReturn($expected);

        $actual = $this->service->delete($publicationGalleySettingId);
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