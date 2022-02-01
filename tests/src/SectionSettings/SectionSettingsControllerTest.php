<?php

declare(strict_types=1);

namespace OJS\Tests\SectionSettings;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\SectionSettings\{ SectionSettingsDto, SectionSettingsModel, SectionSettingsController };

class SectionSettingsControllerTest extends TestCase
{
    private array $input;
    private SectionSettingsDto $dto;
    private SectionSettingsModel $model;
    private MockObject $service;
    private MockObject $request;
    private MockObject $stream;
    private SectionSettingsController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "section_setting_id" => 8833,
            "section_id" => 1645,
            "locale" => "East space show past business property truth. Minute play sea authority ground wide address tax. Responsibility sister lead field five condition relationship.",
            "setting_name" => "Speech site possible the trade open character. However seek child shake federal foreign. Social nearly culture. Budget lay option scientist year American.",
            "setting_value" => "Per line then than real money tonight. Check I happen they ask sing cover lot.",
            "setting_type" => "Stuff there law. Subject town girl commercial understand peace.",
        ];
        $this->dto = new SectionSettingsDto($this->input);
        $this->model = new SectionSettingsModel($this->dto);
        $this->service = $this->createMock("OJS\SectionSettings\ISectionSettingsService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new SectionSettingsController(
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
        $id = 7673;
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
        $args = ["section_setting_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 622;
        $expected = ["result" => $id];
        $args = ["section_setting_id" => 8222];

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
        $args = ["section_setting_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["section_setting_id" => 783];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["section_setting_id"])
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
        $args = ["section_setting_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 272;
        $expected = ["result" => $id];
        $args = ["section_setting_id" => 6837];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["section_setting_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}