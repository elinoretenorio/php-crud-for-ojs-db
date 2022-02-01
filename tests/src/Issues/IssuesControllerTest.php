<?php

declare(strict_types=1);

namespace OJS\Tests\Issues;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Issues\{ IssuesDto, IssuesModel, IssuesController };

class IssuesControllerTest extends TestCase
{
    private array $input;
    private IssuesDto $dto;
    private IssuesModel $model;
    private MockObject $service;
    private MockObject $request;
    private MockObject $stream;
    private IssuesController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "issue_id" => 7403,
            "journal_id" => 8393,
            "volume" => 4812,
            "number" => "Oil lot find. Yourself against way memory science beyond training sell.",
            "year" => 6017,
            "published" => 7735,
            "date_published" => "2022-02-23",
            "date_notified" => "2022-02-11",
            "last_modified" => "2022-02-26",
            "access_status" => 3834,
            "open_access_date" => "2022-02-02",
            "show_volume" => 9498,
            "show_number" => 8417,
            "show_year" => 7674,
            "show_title" => 4600,
            "style_file_name" => "Name civil official year most prevent economy Republican.",
            "original_style_file_name" => "Somebody well design decade difference and across. Order seek property turn station.",
            "url_path" => "Information medical mouth around until. Whether many PM within contain tree adult. After rather defense describe can late hotel.",
        ];
        $this->dto = new IssuesDto($this->input);
        $this->model = new IssuesModel($this->dto);
        $this->service = $this->createMock("OJS\Issues\IIssuesService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new IssuesController(
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
        $id = 7162;
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
        $args = ["issue_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 9686;
        $expected = ["result" => $id];
        $args = ["issue_id" => 2750];

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
        $args = ["issue_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["issue_id" => 6957];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["issue_id"])
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
        $args = ["issue_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 7938;
        $expected = ["result" => $id];
        $args = ["issue_id" => 3262];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["issue_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}