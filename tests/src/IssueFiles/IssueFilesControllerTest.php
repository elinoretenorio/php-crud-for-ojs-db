<?php

declare(strict_types=1);

namespace OJS\Tests\IssueFiles;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\IssueFiles\{ IssueFilesDto, IssueFilesModel, IssueFilesController };

class IssueFilesControllerTest extends TestCase
{
    private array $input;
    private IssueFilesDto $dto;
    private IssueFilesModel $model;
    private MockObject $service;
    private MockObject $request;
    private MockObject $stream;
    private IssueFilesController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "file_id" => 7131,
            "issue_id" => 2514,
            "file_name" => "Daughter defense others each. Room site purpose. Fight on task almost if.",
            "file_type" => "Force in point information full reflect on court. Military occur exist collection.",
            "file_size" => 166,
            "content_type" => 3629,
            "original_file_name" => "Contain better much until begin. Fine woman behavior everybody effort white high.",
            "date_uploaded" => "2022-02-28",
            "date_modified" => "2022-02-19",
        ];
        $this->dto = new IssueFilesDto($this->input);
        $this->model = new IssueFilesModel($this->dto);
        $this->service = $this->createMock("OJS\IssueFiles\IIssueFilesService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new IssueFilesController(
            $this->service
        );

        $this->stream->method("getContents")
            ->willReturn("[]");

        $this->request->method("getBody")
            ->willReturn($this->stream);

        $this->request->method("getParsedBody")
            ->willReturn($this->input);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
        unset($this->request);
        unset($this->stream);
        unset($this->controller);
    }

    public function testInsert_ReturnsResponse(): void
    {
        $id = 785;
        $expected = ["result" => $id];
        $args = [];

        $this->service->expects($this->once())
            ->method("createModel")
            ->with($this->request->getParsedBody())
            ->willReturn($this->model);
        $this->service->expects($this->once())
            ->method("insert")
            ->with($this->model)
            ->willReturn($id);

        $actual = $this->controller->insert($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["file_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 5188;
        $expected = ["result" => $id];
        $args = ["file_id" => 9193];

        $this->service->expects($this->once())
            ->method("createModel")
            ->with($this->request->getParsedBody())
            ->willReturn($this->model);
        $this->service->expects($this->once())
            ->method("update")
            ->with($this->model)
            ->willReturn($id);

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["file_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["file_id" => 2941];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["file_id"])
            ->willReturn($this->model);

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGetAll_ReturnsResponse(): void
    {
        $expected = ["result" => [$this->model->jsonSerialize()]];
        $args = [];

        $this->service->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->model]);

        $actual = $this->controller->getAll($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["file_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 1897;
        $expected = ["result" => $id];
        $args = ["file_id" => 8938];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["file_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}