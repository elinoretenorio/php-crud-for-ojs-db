<?php

declare(strict_types=1);

namespace OJS\Tests\IssueFiles;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\IssueFiles\{ IssueFilesDto, IssueFilesModel, IIssueFilesService, IssueFilesService };

class IssueFilesServiceTest extends TestCase
{
    private MockObject $repository;
    private array $input;
    private IssueFilesDto $dto;
    private IssueFilesModel $model;
    private IIssueFilesService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("OJS\IssueFiles\IIssueFilesRepository");
        $this->input = [
            "file_id" => 7273,
            "issue_id" => 819,
            "file_name" => "Stuff camera executive executive now certain budget. Let spring husband animal foreign.",
            "file_type" => "Society around time from. Simple walk us final age line.",
            "file_size" => 7594,
            "content_type" => 9051,
            "original_file_name" => "Say fly describe behind risk customer so. Response story theory hard game material white. Wind local care must so argue score.",
            "date_uploaded" => "2022-02-05",
            "date_modified" => "2022-02-15",
        ];
        $this->dto = new IssueFilesDto($this->input);
        $this->model = new IssueFilesModel($this->dto);
        $this->service = new IssueFilesService($this->repository);
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
        $expected = 6598;

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
        $expected = 1300;

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
        $fileId = 8030;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($fileId)
            ->willReturn(null);

        $actual = $this->service->get($fileId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $fileId = 3253;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($fileId)
            ->willReturn($this->dto);

        $actual = $this->service->get($fileId);
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
        $fileId = 7094;
        $expected = 2757;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($fileId)
            ->willReturn($expected);

        $actual = $this->service->delete($fileId);
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