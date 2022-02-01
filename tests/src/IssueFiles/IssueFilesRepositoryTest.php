<?php

declare(strict_types=1);

namespace OJS\Tests\IssueFiles;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Database\DatabaseException;
use OJS\IssueFiles\{ IssueFilesDto, IIssueFilesRepository, IssueFilesRepository };

class IssueFilesRepositoryTest extends TestCase
{
    private MockObject $db;
    private MockObject $result;
    private array $input;
    private IssueFilesDto $dto;
    private IIssueFilesRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("OJS\Database\IDatabase");
        $this->result = $this->createMock("OJS\Database\IDatabaseResult");
        $this->input = [
            "file_id" => 5617,
            "issue_id" => 3994,
            "file_name" => "Person spring offer plant recognize. Camera section value low gun court. Responsibility room thus perhaps. Understand subject manage.",
            "file_type" => "Everybody nor seek itself time. Nature agent wrong laugh. Card cause recently analysis.",
            "file_size" => 5104,
            "content_type" => 9039,
            "original_file_name" => "Nice when phone seven night. Production theory property send magazine energy hard. These space hit fly.",
            "date_uploaded" => "2022-02-03",
            "date_modified" => "2022-02-11",
        ];
        $this->dto = new IssueFilesDto($this->input);
        $this->repository = new IssueFilesRepository($this->db);
    }

    protected function tearDown(): void
    {
        unset($this->db);
        unset($this->result);
        unset($this->input);
        unset($this->dto);
        unset($this->repository);
    }

    public function testInsert_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 7392;

        $sql = "INSERT INTO `issue_files` (`issue_id`, `file_name`, `file_type`, `file_size`, `content_type`, `original_file_name`, `date_uploaded`, `date_modified`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->issueId,
                $this->dto->fileName,
                $this->dto->fileType,
                $this->dto->fileSize,
                $this->dto->contentType,
                $this->dto->originalFileName,
                $this->dto->dateUploaded,
                $this->dto->dateModified
            ]);
        $this->db->expects($this->once())
            ->method("lastInsertId")
            ->willReturn($expected);

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 2129;

        $sql = "UPDATE `issue_files` SET `issue_id` = ?, `file_name` = ?, `file_type` = ?, `file_size` = ?, `content_type` = ?, `original_file_name` = ?, `date_uploaded` = ?, `date_modified` = ?
                WHERE `file_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->issueId,
                $this->dto->fileName,
                $this->dto->fileType,
                $this->dto->fileSize,
                $this->dto->contentType,
                $this->dto->originalFileName,
                $this->dto->dateUploaded,
                $this->dto->dateModified,
                $this->dto->fileId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $fileId = 8515;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($fileId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $fileId = 4991;

        $sql = "SELECT `file_id`, `issue_id`, `file_name`, `file_type`, `file_size`, `content_type`, `original_file_name`, `date_uploaded`, `date_modified`
                FROM `issue_files` WHERE `file_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$fileId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($fileId);
        $this->assertEquals($this->dto, $actual);
    }

    public function testGetAll_ReturnsEmptyOnException(): void
    {
        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsDtos(): void
    {
        $sql = "SELECT `file_id`, `issue_id`, `file_name`, `file_type`, `file_size`, `content_type`, `original_file_name`, `date_uploaded`, `date_modified`
                FROM `issue_files`";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute");
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->getAll();
        $this->assertEquals([$this->dto], $actual);
    }

    public function testDelete_ReturnsFailedOnException(): void
    {
        $fileId = 2303;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($fileId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $fileId = 3894;
        $expected = 5321;

        $sql = "DELETE FROM `issue_files` WHERE `file_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$fileId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($fileId);
        $this->assertEquals($expected, $actual);
    }
}