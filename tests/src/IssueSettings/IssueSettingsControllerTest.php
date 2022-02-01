<?php

declare(strict_types=1);

namespace OJS\Tests\IssueSettings;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\IssueSettings\{ IssueSettingsDto, IssueSettingsModel, IssueSettingsController };

class IssueSettingsControllerTest extends TestCase
{
    private array $input;
    private IssueSettingsDto $dto;
    private IssueSettingsModel $model;
    private MockObject $service;
    private MockObject $request;
    private MockObject $stream;
    private IssueSettingsController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "issue_setting_id" => 4120,
            "issue_id" => 9917,
            "locale" => "Across scientist kid region few organization soldier. Free certainly marriage buy treatment cover. Away loss either letter rate firm spring.",
            "setting_name" => "Production arm little affect arm believe. Forward reveal market feel leg too I always. Send person enough value air big.",
            "setting_value" => "Wall mention successful too series. Free sign skill. Game stop bill nation how.",
            "setting_type" => "Radio relate direction because. Friend represent else bed. Person case really toward town thus reflect.",
        ];
        $this->dto = new IssueSettingsDto($this->input);
        $this->model = new IssueSettingsModel($this->dto);
        $this->service = $this->createMock("OJS\IssueSettings\IIssueSettingsService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new IssueSettingsController(
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
        $id = 5775;
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
        $args = ["issue_setting_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 5325;
        $expected = ["result" => $id];
        $args = ["issue_setting_id" => 5954];

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
        $args = ["issue_setting_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["issue_setting_id" => 6143];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["issue_setting_id"])
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
        $args = ["issue_setting_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 3119;
        $expected = ["result" => $id];
        $args = ["issue_setting_id" => 2350];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["issue_setting_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}