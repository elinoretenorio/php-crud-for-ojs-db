<?php

declare(strict_types=1);

namespace OJS\Tests\PublicationGalleys;

use PHPUnit\Framework\TestCase;
use OJS\PublicationGalleys\{ PublicationGalleysDto, PublicationGalleysModel };

class PublicationGalleysModelTest extends TestCase
{
    private array $input;
    private PublicationGalleysDto $dto;
    private PublicationGalleysModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "galley_id" => 4548,
            "locale" => "Anyone somebody heart care political watch see. Soon purpose beyond until. Argue social industry teach south north professor central.",
            "publication_id" => 7806,
            "label" => "Thought current fact field successful spend. Player result network smile head tell your.",
            "submission_file_id" => 8429,
            "seq" => 772.33,
            "remote_url" => "Feeling tough outside. Window kid put else find but. Much happy just security land simple. Task read manager city.",
            "is_approved" => 6737,
            "url_path" => "Center kitchen need section turn interview. Central my senior similar room where instead.",
        ];
        $this->dto = new PublicationGalleysDto($this->input);
        $this->model = new PublicationGalleysModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new PublicationGalleysModel(null);

        $this->assertInstanceOf(PublicationGalleysModel::class, $model);
    }

    public function testGetGalleyId(): void
    {
        $this->assertEquals($this->dto->galleyId, $this->model->getGalleyId());
    }

    public function testSetGalleyId(): void
    {
        $expected = 2799;
        $model = $this->model;
        $model->setGalleyId($expected);

        $this->assertEquals($expected, $model->getGalleyId());
    }

    public function testGetLocale(): void
    {
        $this->assertEquals($this->dto->locale, $this->model->getLocale());
    }

    public function testSetLocale(): void
    {
        $expected = "Fish ask activity Mrs give. Baby west play economy recognize idea between issue.";
        $model = $this->model;
        $model->setLocale($expected);

        $this->assertEquals($expected, $model->getLocale());
    }

    public function testGetPublicationId(): void
    {
        $this->assertEquals($this->dto->publicationId, $this->model->getPublicationId());
    }

    public function testSetPublicationId(): void
    {
        $expected = 8110;
        $model = $this->model;
        $model->setPublicationId($expected);

        $this->assertEquals($expected, $model->getPublicationId());
    }

    public function testGetLabel(): void
    {
        $this->assertEquals($this->dto->label, $this->model->getLabel());
    }

    public function testSetLabel(): void
    {
        $expected = "Goal spring among. Front sort bring wrong quite tend.";
        $model = $this->model;
        $model->setLabel($expected);

        $this->assertEquals($expected, $model->getLabel());
    }

    public function testGetSubmissionFileId(): void
    {
        $this->assertEquals($this->dto->submissionFileId, $this->model->getSubmissionFileId());
    }

    public function testSetSubmissionFileId(): void
    {
        $expected = 3309;
        $model = $this->model;
        $model->setSubmissionFileId($expected);

        $this->assertEquals($expected, $model->getSubmissionFileId());
    }

    public function testGetSeq(): void
    {
        $this->assertEquals($this->dto->seq, $this->model->getSeq());
    }

    public function testSetSeq(): void
    {
        $expected = 293.35;
        $model = $this->model;
        $model->setSeq($expected);

        $this->assertEquals($expected, $model->getSeq());
    }

    public function testGetRemoteUrl(): void
    {
        $this->assertEquals($this->dto->remoteUrl, $this->model->getRemoteUrl());
    }

    public function testSetRemoteUrl(): void
    {
        $expected = "Clearly size them eat young day. Check this interest eye beat trade success.";
        $model = $this->model;
        $model->setRemoteUrl($expected);

        $this->assertEquals($expected, $model->getRemoteUrl());
    }

    public function testGetIsApproved(): void
    {
        $this->assertEquals($this->dto->isApproved, $this->model->getIsApproved());
    }

    public function testSetIsApproved(): void
    {
        $expected = 421;
        $model = $this->model;
        $model->setIsApproved($expected);

        $this->assertEquals($expected, $model->getIsApproved());
    }

    public function testGetUrlPath(): void
    {
        $this->assertEquals($this->dto->urlPath, $this->model->getUrlPath());
    }

    public function testSetUrlPath(): void
    {
        $expected = "Away clear road hold receive around. Air themselves edge think manager his fund.";
        $model = $this->model;
        $model->setUrlPath($expected);

        $this->assertEquals($expected, $model->getUrlPath());
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