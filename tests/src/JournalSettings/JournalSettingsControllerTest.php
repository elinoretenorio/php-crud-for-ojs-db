<?php

declare(strict_types=1);

namespace OJS\Tests\JournalSettings;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\JournalSettings\{ JournalSettingsDto, JournalSettingsModel, JournalSettingsController };

class JournalSettingsControllerTest extends TestCase
{
    private array $input;
    private JournalSettingsDto $dto;
    private JournalSettingsModel $model;
    private MockObject $service;
    private MockObject $request;
    private MockObject $stream;
    private JournalSettingsController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "journal_setting_id" => 3061,
            "journal_id" => 5179,
            "locale" => "Whole central then small fast control. Get own food since piece eye.",
            "setting_name" => "Friend talk decision. West visit daughter. Sister development across among fight anything.",
            "setting_value" => "Mouth seat or like down sure skin low. Through threat author day force yourself.",
            "setting_type" => "Product day hit next son. Son community news clear no house play.",
        ];
        $this->dto = new JournalSettingsDto($this->input);
        $this->model = new JournalSettingsModel($this->dto);
        $this->service = $this->createMock("OJS\JournalSettings\IJournalSettingsService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new JournalSettingsController(
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
        $id = 839;
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
        $args = ["journal_setting_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 3783;
        $expected = ["result" => $id];
        $args = ["journal_setting_id" => 8023];

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
        $args = ["journal_setting_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["journal_setting_id" => 1340];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["journal_setting_id"])
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
        $args = ["journal_setting_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 4352;
        $expected = ["result" => $id];
        $args = ["journal_setting_id" => 558];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["journal_setting_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}