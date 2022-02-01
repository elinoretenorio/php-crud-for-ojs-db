<?php

declare(strict_types=1);

namespace OJS\Tests\Publications;

use PHPUnit\Framework\TestCase;
use OJS\Publications\{ PublicationsDto, PublicationsModel };

class PublicationsModelTest extends TestCase
{
    private array $input;
    private PublicationsDto $dto;
    private PublicationsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "publication_id" => 9200,
            "access_status" => 593,
            "date_published" => "2022-02-12",
            "last_modified" => "2022-03-01",
            "primary_contact_id" => 410,
            "section_id" => 7890,
            "seq" => 940.59,
            "submission_id" => 6000,
            "status" => 3489,
            "url_path" => "Admit focus better investment get common professional. Must account wonder him day successful area.",
            "version" => 469,
        ];
        $this->dto = new PublicationsDto($this->input);
        $this->model = new PublicationsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new PublicationsModel(null);

        $this->assertInstanceOf(PublicationsModel::class, $model);
    }

    public function testGetPublicationId(): void
    {
        $this->assertEquals($this->dto->publicationId, $this->model->getPublicationId());
    }

    public function testSetPublicationId(): void
    {
        $expected = 2641;
        $model = $this->model;
        $model->setPublicationId($expected);

        $this->assertEquals($expected, $model->getPublicationId());
    }

    public function testGetAccessStatus(): void
    {
        $this->assertEquals($this->dto->accessStatus, $this->model->getAccessStatus());
    }

    public function testSetAccessStatus(): void
    {
        $expected = 1143;
        $model = $this->model;
        $model->setAccessStatus($expected);

        $this->assertEquals($expected, $model->getAccessStatus());
    }

    public function testGetDatePublished(): void
    {
        $this->assertEquals($this->dto->datePublished, $this->model->getDatePublished());
    }

    public function testSetDatePublished(): void
    {
        $expected = "2022-02-18";
        $model = $this->model;
        $model->setDatePublished($expected);

        $this->assertEquals($expected, $model->getDatePublished());
    }

    public function testGetLastModified(): void
    {
        $this->assertEquals($this->dto->lastModified, $this->model->getLastModified());
    }

    public function testSetLastModified(): void
    {
        $expected = "2022-02-28";
        $model = $this->model;
        $model->setLastModified($expected);

        $this->assertEquals($expected, $model->getLastModified());
    }

    public function testGetPrimaryContactId(): void
    {
        $this->assertEquals($this->dto->primaryContactId, $this->model->getPrimaryContactId());
    }

    public function testSetPrimaryContactId(): void
    {
        $expected = 4071;
        $model = $this->model;
        $model->setPrimaryContactId($expected);

        $this->assertEquals($expected, $model->getPrimaryContactId());
    }

    public function testGetSectionId(): void
    {
        $this->assertEquals($this->dto->sectionId, $this->model->getSectionId());
    }

    public function testSetSectionId(): void
    {
        $expected = 6595;
        $model = $this->model;
        $model->setSectionId($expected);

        $this->assertEquals($expected, $model->getSectionId());
    }

    public function testGetSeq(): void
    {
        $this->assertEquals($this->dto->seq, $this->model->getSeq());
    }

    public function testSetSeq(): void
    {
        $expected = 567.48;
        $model = $this->model;
        $model->setSeq($expected);

        $this->assertEquals($expected, $model->getSeq());
    }

    public function testGetSubmissionId(): void
    {
        $this->assertEquals($this->dto->submissionId, $this->model->getSubmissionId());
    }

    public function testSetSubmissionId(): void
    {
        $expected = 7665;
        $model = $this->model;
        $model->setSubmissionId($expected);

        $this->assertEquals($expected, $model->getSubmissionId());
    }

    public function testGetStatus(): void
    {
        $this->assertEquals($this->dto->status, $this->model->getStatus());
    }

    public function testSetStatus(): void
    {
        $expected = 8499;
        $model = $this->model;
        $model->setStatus($expected);

        $this->assertEquals($expected, $model->getStatus());
    }

    public function testGetUrlPath(): void
    {
        $this->assertEquals($this->dto->urlPath, $this->model->getUrlPath());
    }

    public function testSetUrlPath(): void
    {
        $expected = "Military place occur ready partner participant college. Real successful number first data together.";
        $model = $this->model;
        $model->setUrlPath($expected);

        $this->assertEquals($expected, $model->getUrlPath());
    }

    public function testGetVersion(): void
    {
        $this->assertEquals($this->dto->version, $this->model->getVersion());
    }

    public function testSetVersion(): void
    {
        $expected = 8643;
        $model = $this->model;
        $model->setVersion($expected);

        $this->assertEquals($expected, $model->getVersion());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}