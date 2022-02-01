<?php

declare(strict_types=1);

namespace OJS\Tests\IssueGalleys;

use PHPUnit\Framework\TestCase;
use OJS\IssueGalleys\{ IssueGalleysDto, IssueGalleysModel };

class IssueGalleysModelTest extends TestCase
{
    private array $input;
    private IssueGalleysDto $dto;
    private IssueGalleysModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "galley_id" => 9219,
            "locale" => "Threat thus among wonder. First its goal understand.",
            "issue_id" => 2559,
            "file_id" => 5761,
            "label" => "Show office learn check avoid teacher. Early officer production under. Only foot question.",
            "seq" => 74.35,
            "url_path" => "My key free director everything. Candidate measure both space foot. Memory Republican where cultural although record never.",
        ];
        $this->dto = new IssueGalleysDto($this->input);
        $this->model = new IssueGalleysModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new IssueGalleysModel(null);

        $this->assertInstanceOf(IssueGalleysModel::class, $model);
    }

    public function testGetGalleyId(): void
    {
        $this->assertEquals($this->dto->galleyId, $this->model->getGalleyId());
    }

    public function testSetGalleyId(): void
    {
        $expected = 8684;
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
        $expected = "Bank country bank activity power. Threat oil amount.";
        $model = $this->model;
        $model->setLocale($expected);

        $this->assertEquals($expected, $model->getLocale());
    }

    public function testGetIssueId(): void
    {
        $this->assertEquals($this->dto->issueId, $this->model->getIssueId());
    }

    public function testSetIssueId(): void
    {
        $expected = 4365;
        $model = $this->model;
        $model->setIssueId($expected);

        $this->assertEquals($expected, $model->getIssueId());
    }

    public function testGetFileId(): void
    {
        $this->assertEquals($this->dto->fileId, $this->model->getFileId());
    }

    public function testSetFileId(): void
    {
        $expected = 2925;
        $model = $this->model;
        $model->setFileId($expected);

        $this->assertEquals($expected, $model->getFileId());
    }

    public function testGetLabel(): void
    {
        $this->assertEquals($this->dto->label, $this->model->getLabel());
    }

    public function testSetLabel(): void
    {
        $expected = "Fund responsibility apply need. Series travel than argue.";
        $model = $this->model;
        $model->setLabel($expected);

        $this->assertEquals($expected, $model->getLabel());
    }

    public function testGetSeq(): void
    {
        $this->assertEquals($this->dto->seq, $this->model->getSeq());
    }

    public function testSetSeq(): void
    {
        $expected = 715.52;
        $model = $this->model;
        $model->setSeq($expected);

        $this->assertEquals($expected, $model->getSeq());
    }

    public function testGetUrlPath(): void
    {
        $this->assertEquals($this->dto->urlPath, $this->model->getUrlPath());
    }

    public function testSetUrlPath(): void
    {
        $expected = "Agency hit PM writer. Modern old reveal.";
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