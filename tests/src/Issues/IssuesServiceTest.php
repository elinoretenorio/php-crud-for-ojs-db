<?php

declare(strict_types=1);

namespace OJS\Tests\Issues;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Issues\{ IssuesDto, IssuesModel, IIssuesService, IssuesService };

class IssuesServiceTest extends TestCase
{
    private MockObject $repository;
    private array $input;
    private IssuesDto $dto;
    private IssuesModel $model;
    private IIssuesService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("OJS\Issues\IIssuesRepository");
        $this->input = [
            "issue_id" => 125,
            "journal_id" => 5078,
            "volume" => 8076,
            "number" => "Inside prepare remember blue really. Real year cold generation.",
            "year" => 1904,
            "published" => 2700,
            "date_published" => "2022-02-15",
            "date_notified" => "2022-03-01",
            "last_modified" => "2022-02-21",
            "access_status" => 2654,
            "open_access_date" => "2022-02-13",
            "show_volume" => 7189,
            "show_number" => 5343,
            "show_year" => 1934,
            "show_title" => 1141,
            "style_file_name" => "Professor remain room carry.",
            "original_style_file_name" => "Identify job already something future very. Just long serious store few. Instead hospital interesting collection dream trip ability.",
            "url_path" => "Democratic suggest social. Thank once listen able. Matter science financial care first.",
        ];
        $this->dto = new IssuesDto($this->input);
        $this->model = new IssuesModel($this->dto);
        $this->service = new IssuesService($this->repository);
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
        $expected = 5631;

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
        $expected = 355;

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
        $issueId = 6052;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($issueId)
            ->willReturn(null);

        $actual = $this->service->get($issueId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $issueId = 1992;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($issueId)
            ->willReturn($this->dto);

        $actual = $this->service->get($issueId);
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
        $issueId = 3434;
        $expected = 2280;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($issueId)
            ->willReturn($expected);

        $actual = $this->service->delete($issueId);
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