<?php

declare(strict_types=1);

namespace OJS\Tests\IssueGalleySettings;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\IssueGalleySettings\{ IssueGalleySettingsDto, IssueGalleySettingsModel, IssueGalleySettingsController };

class IssueGalleySettingsControllerTest extends TestCase
{
    private array $input;
    private IssueGalleySettingsDto $dto;
    private IssueGalleySettingsModel $model;
    private MockObject $service;
    private MockObject $request;
    private MockObject $stream;
    private IssueGalleySettingsController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "issue_galley_setting_id" => 2140,
            "galley_id" => 998,
            "locale" => "Apply weight reduce determine international. Heavy contain necessary kid economic.",
            "setting_name" => "Travel minute response find. Hospital home real.",
            "setting_value" => "Including organization take their staff natural. Owner move on scientist word have budget. Major contain debate newspaper strong watch leave.",
            "setting_type" => "Sound market stuff. Once authority animal president somebody.",
        ];
        $this->dto = new IssueGalleySettingsDto($this->input);
        $this->model = new IssueGalleySettingsModel($this->dto);
        $this->service = $this->createMock("OJS\IssueGalleySettings\IIssueGalleySettingsService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new IssueGalleySettingsController(
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
        $id = 4555;
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
        $id = 7156;
        $expected = ["result" => $id];
        $args = ["galley_id" => 6489];

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
        $args = ["galley_id" => 6371];

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
        $id = 1127;
        $expected = ["result" => $id];
        $args = ["galley_id" => 5853];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["galley_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}