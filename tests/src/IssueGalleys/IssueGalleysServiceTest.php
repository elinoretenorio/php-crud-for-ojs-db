<?php

declare(strict_types=1);

namespace OJS\Tests\IssueGalleys;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\IssueGalleys\{ IssueGalleysDto, IssueGalleysModel, IIssueGalleysService, IssueGalleysService };

class IssueGalleysServiceTest extends TestCase
{
    private MockObject $repository;
    private array $input;
    private IssueGalleysDto $dto;
    private IssueGalleysModel $model;
    private IIssueGalleysService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("OJS\IssueGalleys\IIssueGalleysRepository");
        $this->input = [
            "galley_id" => 4419,
            "locale" => "Capital capital around wear beautiful lead reduce. Test address avoid partner. Window sell western fight phone.",
            "issue_id" => 5815,
            "file_id" => 1645,
            "label" => "Anything federal treatment senior. Think himself particular camera individual grow.",
            "seq" => 624.71,
            "url_path" => "Him single up attack. Organization these themselves husband light eight national. Forget because fund hope.",
        ];
        $this->dto = new IssueGalleysDto($this->input);
        $this->model = new IssueGalleysModel($this->dto);
        $this->service = new IssueGalleysService($this->repository);
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
        $expected = 763;

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
        $expected = 6154;

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
        $galleyId = 4060;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($galleyId)
            ->willReturn(null);

        $actual = $this->service->get($galleyId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $galleyId = 9289;

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
        $galleyId = 6147;
        $expected = 4382;

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