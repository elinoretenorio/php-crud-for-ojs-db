<?php

declare(strict_types=1);

namespace OJS\Tests\CompletedPayments;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\CompletedPayments\{ CompletedPaymentsDto, CompletedPaymentsModel, CompletedPaymentsController };

class CompletedPaymentsControllerTest extends TestCase
{
    private array $input;
    private CompletedPaymentsDto $dto;
    private CompletedPaymentsModel $model;
    private MockObject $service;
    private MockObject $request;
    private MockObject $stream;
    private CompletedPaymentsController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "completed_payment_id" => 9990,
            "timestamp" => "2022-02-22",
            "payment_type" => 1875,
            "context_id" => 680,
            "user_id" => 7902,
            "assoc_id" => 1430,
            "amount" => 369.66,
            "currency_code_alpha" => "Lose well black middle success class. Act week must go well. Notice although land.",
            "payment_method_plugin_name" => "Word that as marriage third. Of price energy for. Beautiful recently girl drug.",
        ];
        $this->dto = new CompletedPaymentsDto($this->input);
        $this->model = new CompletedPaymentsModel($this->dto);
        $this->service = $this->createMock("OJS\CompletedPayments\ICompletedPaymentsService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new CompletedPaymentsController(
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
        $id = 4675;
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
        $args = ["completed_payment_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 3219;
        $expected = ["result" => $id];
        $args = ["completed_payment_id" => 3762];

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
        $args = ["completed_payment_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["completed_payment_id" => 2485];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["completed_payment_id"])
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
        $args = ["completed_payment_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 652;
        $expected = ["result" => $id];
        $args = ["completed_payment_id" => 7104];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["completed_payment_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}