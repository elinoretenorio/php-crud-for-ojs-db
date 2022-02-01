<?php

declare(strict_types=1);

namespace OJS\Tests\PublicationGalleySettings;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\PublicationGalleySettings\{ PublicationGalleySettingsDto, PublicationGalleySettingsModel, PublicationGalleySettingsController };

class PublicationGalleySettingsControllerTest extends TestCase
{
    private array $input;
    private PublicationGalleySettingsDto $dto;
    private PublicationGalleySettingsModel $model;
    private MockObject $service;
    private MockObject $request;
    private MockObject $stream;
    private PublicationGalleySettingsController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "publication_galley_setting_id" => 6617,
            "galley_id" => 7384,
            "locale" => "Address act decide task should this staff trial. Hard certain letter then size. Those clear policy bank them produce everyone especially.",
            "setting_name" => "Particularly daughter protect where. Follow purpose movie politics. Here really heavy operation knowledge product.",
            "setting_value" => "On small month including movie. Early interesting sister police grow. Tax space serious apply involve wish. Government memory yet there several very east.",
        ];
        $this->dto = new PublicationGalleySettingsDto($this->input);
        $this->model = new PublicationGalleySettingsModel($this->dto);
        $this->service = $this->createMock("OJS\PublicationGalleySettings\IPublicationGalleySettingsService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new PublicationGalleySettingsController(
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
        $id = 679;
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
        $args = ["publication_galley_setting_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 4490;
        $expected = ["result" => $id];
        $args = ["publication_galley_setting_id" => 2406];

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
        $args = ["publication_galley_setting_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["publication_galley_setting_id" => 6489];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["publication_galley_setting_id"])
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
        $args = ["publication_galley_setting_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 2487;
        $expected = ["result" => $id];
        $args = ["publication_galley_setting_id" => 2378];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["publication_galley_setting_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}