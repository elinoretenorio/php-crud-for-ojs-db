<?php

declare(strict_types=1);

namespace OJS\Tests\Journals;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Journals\{ JournalsDto, JournalsModel, IJournalsService, JournalsService };

class JournalsServiceTest extends TestCase
{
    private MockObject $repository;
    private array $input;
    private JournalsDto $dto;
    private JournalsModel $model;
    private IJournalsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("OJS\Journals\IJournalsRepository");
        $this->input = [
            "journal_id" => 4752,
            "path" => "Significant figure treat. Mention increase identify federal party break.",
            "seq" => 359.51,
            "primary_locale" => "Organization by use box could. Action instead decision place film. Education drive treat life character.",
            "enabled" => 8887,
            "current_issue_id" => 3072,
        ];
        $this->dto = new JournalsDto($this->input);
        $this->model = new JournalsModel($this->dto);
        $this->service = new JournalsService($this->repository);
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
        $expected = 751;

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
        $expected = 2302;

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
        $journalId = 1708;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($journalId)
            ->willReturn(null);

        $actual = $this->service->get($journalId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $journalId = 5890;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($journalId)
            ->willReturn($this->dto);

        $actual = $this->service->get($journalId);
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
        $journalId = 1071;
        $expected = 4523;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($journalId)
            ->willReturn($expected);

        $actual = $this->service->delete($journalId);
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