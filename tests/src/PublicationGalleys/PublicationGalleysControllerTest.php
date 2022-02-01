<?php

declare(strict_types=1);

namespace OJS\Tests\PublicationGalleys;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\PublicationGalleys\{ PublicationGalleysDto, PublicationGalleysModel, PublicationGalleysController };

class PublicationGalleysControllerTest extends TestCase
{
    private array $input;
    private PublicationGalleysDto $dto;
    private PublicationGalleysModel $model;
    private MockObject $service;
    private MockObject $request;
    private MockObject $stream;
    private PublicationGalleysController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "galley_id" => 7583,
            "locale" => "Defense market enjoy born. Discussion turn allow paper thus draw.",
            "publication_id" => 4506,
            "label" => "Others prevent do imagine strategy. Increase word inside however. He language say standard despite serious.",
            "submission_file_id" => 2010,
            "seq" => 21.89,
            "remote_url" => "Of land side plant.",
            "is_approved" => 4389,
            "url_path" => "Month participant individual specific whose hair. Stage five some bill.",
        ];
        $this->dto = new PublicationGalleysDto($this->input);
        $this->model = new PublicationGalleysModel($this->dto);
        $this->service = $this->createMock("OJS\PublicationGalleys\IPublicationGalleysService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new PublicationGalleysController(
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
        $id = 3923;
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
        $id = 4613;
        $expected = ["result" => $id];
        $args = ["galley_id" => 9198];

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
        $args = ["galley_id" => 4248];

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
        $id = 703;
        $expected = ["result" => $id];
        $args = ["galley_id" => 6833];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["galley_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}