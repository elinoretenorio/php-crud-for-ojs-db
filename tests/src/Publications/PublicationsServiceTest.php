<?php

declare(strict_types=1);

namespace OJS\Tests\Publications;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Publications\{ PublicationsDto, PublicationsModel, IPublicationsService, PublicationsService };

class PublicationsServiceTest extends TestCase
{
    private MockObject $repository;
    private array $input;
    private PublicationsDto $dto;
    private PublicationsModel $model;
    private IPublicationsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("OJS\Publications\IPublicationsRepository");
        $this->input = [
            "publication_id" => 1374,
            "access_status" => 4724,
            "date_published" => "2022-02-11",
            "last_modified" => "2022-02-08",
            "primary_contact_id" => 3939,
            "section_id" => 782,
            "seq" => 643.70,
            "submission_id" => 6779,
            "status" => 6547,
            "url_path" => "Mother one nothing into significant scene. Exist way more remember air.",
            "version" => 6749,
        ];
        $this->dto = new PublicationsDto($this->input);
        $this->model = new PublicationsModel($this->dto);
        $this->service = new PublicationsService($this->repository);
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
        $expected = 4494;

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
        $expected = 1932;

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
        $publicationId = 9596;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($publicationId)
            ->willReturn(null);

        $actual = $this->service->get($publicationId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $publicationId = 3411;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($publicationId)
            ->willReturn($this->dto);

        $actual = $this->service->get($publicationId);
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
        $publicationId = 9922;
        $expected = 7658;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($publicationId)
            ->willReturn($expected);

        $actual = $this->service->delete($publicationId);
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