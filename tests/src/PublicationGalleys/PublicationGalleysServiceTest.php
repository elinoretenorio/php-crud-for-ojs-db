<?php

declare(strict_types=1);

namespace OJS\Tests\PublicationGalleys;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\PublicationGalleys\{ PublicationGalleysDto, PublicationGalleysModel, IPublicationGalleysService, PublicationGalleysService };

class PublicationGalleysServiceTest extends TestCase
{
    private MockObject $repository;
    private array $input;
    private PublicationGalleysDto $dto;
    private PublicationGalleysModel $model;
    private IPublicationGalleysService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("OJS\PublicationGalleys\IPublicationGalleysRepository");
        $this->input = [
            "galley_id" => 4915,
            "locale" => "Rich most structure too maintain past responsibility. Popular specific share general decade. Hair action you anyone know.",
            "publication_id" => 2090,
            "label" => "Commercial important early ok kid myself want force. Alone discover church simple by inside send.",
            "submission_file_id" => 3324,
            "seq" => 760.80,
            "remote_url" => "Family term model represent message. Upon camera story learn key until.",
            "is_approved" => 5872,
            "url_path" => "Because hard dog machine. Bring standard good once include decide finish. Training state office success.",
        ];
        $this->dto = new PublicationGalleysDto($this->input);
        $this->model = new PublicationGalleysModel($this->dto);
        $this->service = new PublicationGalleysService($this->repository);
    }

    protected function tearDown(): void
    {
        unset($this->repository);
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 8433;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEmpty($actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 6731;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsNull(): void
    {
        $galleyId = 1767;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($galleyId)
            ->willReturn(null);

        $actual = $this->service->get($galleyId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $galleyId = 8114;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($galleyId)
            ->willReturn($this->dto);

        $actual = $this->service->get($galleyId);
        $this->assertEquals($this->model, $actual);
    }

    public function testGetAll_ReturnsEmpty(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([]);

        $actual = $this->service->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsModels(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->dto]);

        $actual = $this->service->getAll();
        $this->assertEquals([$this->model], $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $galleyId = 8998;
        $expected = 3565;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($galleyId)
            ->willReturn($expected);

        $actual = $this->service->delete($galleyId);
        $this->assertEquals($expected, $actual);
    }

    public function testCreateModel_ReturnsNullIfEmpty(): void
    {
        $actual = $this->service->createModel([]);
        $this->assertNull($actual);
    }

    public function testCreateModel_ReturnsModel(): void
    {
        $actual = $this->service->createModel($this->input);
        $this->assertEquals($this->model, $actual);
    }
}