<?php

declare(strict_types=1);

namespace OJS\Tests\InstitutionalSubscriptionIp;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\InstitutionalSubscriptionIp\{ InstitutionalSubscriptionIpDto, InstitutionalSubscriptionIpModel, InstitutionalSubscriptionIpController };

class InstitutionalSubscriptionIpControllerTest extends TestCase
{
    private array $input;
    private InstitutionalSubscriptionIpDto $dto;
    private InstitutionalSubscriptionIpModel $model;
    private MockObject $service;
    private MockObject $request;
    private MockObject $stream;
    private InstitutionalSubscriptionIpController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "institutional_subscription_ip_id" => 8214,
            "subscription_id" => 251,
            "ip_string" => "Relate drop industry option anything us lot. Organization figure action prevent thing everything spring. Should exist person present inside forward method.",
            "ip_start" => 9918,
            "ip_end" => 690,
        ];
        $this->dto = new InstitutionalSubscriptionIpDto($this->input);
        $this->model = new InstitutionalSubscriptionIpModel($this->dto);
        $this->service = $this->createMock("OJS\InstitutionalSubscriptionIp\IInstitutionalSubscriptionIpService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new InstitutionalSubscriptionIpController(
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
        $id = 9347;
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
        $args = ["institutional_subscription_ip_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 9302;
        $expected = ["result" => $id];
        $args = ["institutional_subscription_ip_id" => 8672];

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
        $args = ["institutional_subscription_ip_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["institutional_subscription_ip_id" => 7400];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["institutional_subscription_ip_id"])
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
        $args = ["institutional_subscription_ip_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 7271;
        $expected = ["result" => $id];
        $args = ["institutional_subscription_ip_id" => 5479];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["institutional_subscription_ip_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}