<?php

declare(strict_types=1);

namespace OJS\Tests\InstitutionalSubscriptions;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\InstitutionalSubscriptions\{ InstitutionalSubscriptionsDto, InstitutionalSubscriptionsModel, InstitutionalSubscriptionsController };

class InstitutionalSubscriptionsControllerTest extends TestCase
{
    private array $input;
    private InstitutionalSubscriptionsDto $dto;
    private InstitutionalSubscriptionsModel $model;
    private MockObject $service;
    private MockObject $request;
    private MockObject $stream;
    private InstitutionalSubscriptionsController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "institutional_subscription_id" => 107,
            "subscription_id" => 1904,
            "institution_name" => "Level then record simple become speak care attention. Require budget down yet. Would task through seven.",
            "mailing_address" => "Do maybe art shake record. Top over candidate political total. Bar arm reduce.",
            "domain" => "Light prevent bad in laugh son. Professor with sign reflect Republican.",
        ];
        $this->dto = new InstitutionalSubscriptionsDto($this->input);
        $this->model = new InstitutionalSubscriptionsModel($this->dto);
        $this->service = $this->createMock("OJS\InstitutionalSubscriptions\IInstitutionalSubscriptionsService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new InstitutionalSubscriptionsController(
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
        $id = 5007;
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
        $args = ["institutional_subscription_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 1804;
        $expected = ["result" => $id];
        $args = ["institutional_subscription_id" => 1885];

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
        $args = ["institutional_subscription_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["institutional_subscription_id" => 9759];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["institutional_subscription_id"])
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
        $args = ["institutional_subscription_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 1286;
        $expected = ["result" => $id];
        $args = ["institutional_subscription_id" => 499];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["institutional_subscription_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}