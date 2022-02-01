<?php

declare(strict_types=1);

namespace OJS\Tests\Subscriptions;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Subscriptions\{ SubscriptionsDto, SubscriptionsModel, SubscriptionsController };

class SubscriptionsControllerTest extends TestCase
{
    private array $input;
    private SubscriptionsDto $dto;
    private SubscriptionsModel $model;
    private MockObject $service;
    private MockObject $request;
    private MockObject $stream;
    private SubscriptionsController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "subscription_id" => 8884,
            "journal_id" => 261,
            "user_id" => 772,
            "type_id" => 4124,
            "date_start" => "2022-02-21",
            "date_end" => "2022-02-27",
            "status" => 99,
            "membership" => "Consider follow approach edge degree art reveal system. Concern practice evening art.",
            "reference_number" => "Walk follow wish exist every. Mention own subject power themselves.",
            "notes" => "Discuss responsibility know collection oil year. Man individual us.",
        ];
        $this->dto = new SubscriptionsDto($this->input);
        $this->model = new SubscriptionsModel($this->dto);
        $this->service = $this->createMock("OJS\Subscriptions\ISubscriptionsService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new SubscriptionsController(
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
        $id = 2699;
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
        $args = ["subscription_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 5118;
        $expected = ["result" => $id];
        $args = ["subscription_id" => 7897];

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
        $args = ["subscription_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["subscription_id" => 3525];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["subscription_id"])
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
        $args = ["subscription_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 5128;
        $expected = ["result" => $id];
        $args = ["subscription_id" => 5846];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["subscription_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}