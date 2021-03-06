<?php

declare(strict_types=1);

namespace OJS\Tests\CustomSectionOrders;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\CustomSectionOrders\{ CustomSectionOrdersDto, CustomSectionOrdersModel, CustomSectionOrdersController };

class CustomSectionOrdersControllerTest extends TestCase
{
    private array $input;
    private CustomSectionOrdersDto $dto;
    private CustomSectionOrdersModel $model;
    private MockObject $service;
    private MockObject $request;
    private MockObject $stream;
    private CustomSectionOrdersController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "custom_section_order_id" => 3549,
            "issue_id" => 1883,
            "section_id" => 1565,
            "seq" => 552.47,
        ];
        $this->dto = new CustomSectionOrdersDto($this->input);
        $this->model = new CustomSectionOrdersModel($this->dto);
        $this->service = $this->createMock("OJS\CustomSectionOrders\ICustomSectionOrdersService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new CustomSectionOrdersController(
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
        $id = 9080;
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
        $args = ["custom_section_order_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 2511;
        $expected = ["result" => $id];
        $args = ["custom_section_order_id" => 1700];

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
        $args = ["custom_section_order_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["custom_section_order_id" => 8370];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["custom_section_order_id"])
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
        $args = ["custom_section_order_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 1559;
        $expected = ["result" => $id];
        $args = ["custom_section_order_id" => 9445];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["custom_section_order_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}