<?php

declare(strict_types=1);

namespace OJS\Tests\IssueGalleys;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\IssueGalleys\{ IssueGalleysDto, IssueGalleysModel, IssueGalleysController };

class IssueGalleysControllerTest extends TestCase
{
    private array $input;
    private IssueGalleysDto $dto;
    private IssueGalleysModel $model;
    private MockObject $service;
    private MockObject $request;
    private MockObject $stream;
    private IssueGalleysController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "galley_id" => 6219,
            "locale" => "Indeed trade his eight organization action. Author article such audience purpose popular will best.",
            "issue_id" => 7710,
            "file_id" => 6570,
            "label" => "Artist few base PM evening. Fill crime agreement shoulder.",
            "seq" => 762.40,
            "url_path" => "Simple treatment including service next. Grow air should task inside success author. Else indicate since smile traditional impact generation.",
        ];
        $this->dto = new IssueGalleysDto($this->input);
        $this->model = new IssueGalleysModel($this->dto);
        $this->service = $this->createMock("OJS\IssueGalleys\IIssueGalleysService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new IssueGalleysController(
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
        $id = 5806;
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
        $args = ["galley_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 9240;
        $expected = ["result" => $id];
        $args = ["galley_id" => 3326];

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
        $args = ["galley_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["galley_id" => 8731];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["galley_id"])
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
        $args = ["galley_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 8078;
        $expected = ["result" => $id];
        $args = ["galley_id" => 9586];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["galley_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}