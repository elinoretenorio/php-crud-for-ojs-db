<?php

declare(strict_types=1);

namespace OJS\Tests\SubscriptionTypes;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\SubscriptionTypes\{ SubscriptionTypesDto, SubscriptionTypesModel, SubscriptionTypesController };

class SubscriptionTypesControllerTest extends TestCase
{
    private array $input;
    private SubscriptionTypesDto $dto;
    private SubscriptionTypesModel $model;
    private MockObject $service;
    private MockObject $request;
    private MockObject $stream;
    private SubscriptionTypesController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "type_id" => 1204,
            "journal_id" => 335,
            "cost" => 576.78,
            "currency_code_alpha" => "Concern industry peace site event store. Everyone receive player task friend rock. Use ground opportunity soon.",
            "duration" => 6171,
            "format" => 9690,
            "institutional" => 3376,
            "membership" => 462,
            "disable_public_display" => 6626,
            "seq" => 769.00,
        ];
        $this->dto = new SubscriptionTypesDto($this->input);
        $this->model = new SubscriptionTypesModel($this->dto);
        $this->service = $this->createMock("OJS\SubscriptionTypes\ISubscriptionTypesService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new SubscriptionTypesController(
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
        $id = 2293;
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
        $args = ["type_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 4997;
        $expected = ["result" => $id];
        $args = ["type_id" => 8983];

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
        $args = ["type_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["type_id" => 8681];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["type_id"])
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
        $args = ["type_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 4088;
        $expected = ["result" => $id];
        $args = ["type_id" => 8087];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["type_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}