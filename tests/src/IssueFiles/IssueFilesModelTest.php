<?php

declare(strict_types=1);

namespace OJS\Tests\IssueFiles;

use PHPUnit\Framework\TestCase;
use OJS\IssueFiles\{ IssueFilesDto, IssueFilesModel };

class IssueFilesModelTest extends TestCase
{
    private array $input;
    private IssueFilesDto $dto;
    private IssueFilesModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "file_id" => 5759,
            "issue_id" => 4371,
            "file_name" => "Season billion certainly doctor watch college kid. Thank middle scientist exactly fish. Save control consumer process capital.",
            "file_type" => "Edge finally both within home. Purpose stock brother. Debate better identify great decide.",
            "file_size" => 16,
            "content_type" => 6809,
            "original_file_name" => "System pretty nearly. Skin without somebody government expect. Resource pattern long concern military serve particular.",
            "date_uploaded" => "2022-02-05",
            "date_modified" => "2022-02-03",
        ];
        $this->dto = new IssueFilesDto($this->input);
        $this->model = new IssueFilesModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new IssueFilesModel(null);

        $this->assertInstanceOf(IssueFilesModel::class, $model);
    }

    public function testGetFileId(): void
    {
        $this->assertEquals($this->dto->fileId, $this->model->getFileId());
    }

    public function testSetFileId(): void
    {
        $expected = 9281;
        $model = $this->model;
        $model->setFileId($expected);

        $this->assertEquals($expected, $model->getFileId());
    }

    public function testGetIssueId(): void
    {
        $this->assertEquals($this->dto->issueId, $this->model->getIssueId());
    }

    public function testSetIssueId(): void
    {
        $expected = 8253;
        $model = $this->model;
        $model->setIssueId($expected);

        $this->assertEquals($expected, $model->getIssueId());
    }

    public function testGetFileName(): void
    {
        $this->assertEquals($this->dto->fileName, $this->model->getFileName());
    }

    public function testSetFileName(): void
    {
        $expected = "Ok model remain sport although everybody different prepare. Easy prevent morning anyone if. Process ahead up base trial mention.";
        $model = $this->model;
        $model->setFileName($expected);

        $this->assertEquals($expected, $model->getFileName());
    }

    public function testGetFileType(): void
    {
        $this->assertEquals($this->dto->fileType, $this->model->getFileType());
    }

    public function testSetFileType(): void
    {
        $expected = "Against whom successful team data sign project. Wish civil well.";
        $model = $this->model;
        $model->setFileType($expected);

        $this->assertEquals($expected, $model->getFileType());
    }

    public function testGetFileSize(): void
    {
        $this->assertEquals($this->dto->fileSize, $this->model->getFileSize());
    }

    public function testSetFileSize(): void
    {
        $expected = 9041;
        $model = $this->model;
        $model->setFileSize($expected);

        $this->assertEquals($expected, $model->getFileSize());
    }

    public function testGetContentType(): void
    {
        $this->assertEquals($this->dto->contentType, $this->model->getContentType());
    }

    public function testSetContentType(): void
    {
        $expected = 5976;
        $model = $this->model;
        $model->setContentType($expected);

        $this->assertEquals($expected, $model->getContentType());
    }

    public function testGetOriginalFileName(): void
    {
        $this->assertEquals($this->dto->originalFileName, $this->model->getOriginalFileName());
    }

    public function testSetOriginalFileName(): void
    {
        $expected = "Song human beyond safe agency indeed card. Current ahead form with occur material necessary.";
        $model = $this->model;
        $model->setOriginalFileName($expected);

        $this->assertEquals($expected, $model->getOriginalFileName());
    }

    public function testGetDateUploaded(): void
    {
        $this->assertEquals($this->dto->dateUploaded, $this->model->getDateUploaded());
    }

    public function testSetDateUploaded(): void
    {
        $expected = "2022-02-22";
        $model = $this->model;
        $model->setDateUploaded($expected);

        $this->assertEquals($expected, $model->getDateUploaded());
    }

    public function testGetDateModified(): void
    {
        $this->assertEquals($this->dto->dateModified, $this->model->getDateModified());
    }

    public function testSetDateModified(): void
    {
        $expected = "2022-02-17";
        $model = $this->model;
        $model->setDateModified($expected);

        $this->assertEquals($expected, $model->getDateModified());
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