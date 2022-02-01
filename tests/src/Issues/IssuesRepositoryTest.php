<?php

declare(strict_types=1);

namespace OJS\Tests\Issues;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Database\DatabaseException;
use OJS\Issues\{ IssuesDto, IIssuesRepository, IssuesRepository };

class IssuesRepositoryTest extends TestCase
{
    private MockObject $db;
    private MockObject $result;
    private array $input;
    private IssuesDto $dto;
    private IIssuesRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("OJS\Database\IDatabase");
        $this->result = $this->createMock("OJS\Database\IDatabaseResult");
        $this->input = [
            "issue_id" => 4399,
            "journal_id" => 7339,
            "volume" => 9043,
            "number" => "Never return choice southern she. Though make significant.",
            "year" => 1560,
            "published" => 4967,
            "date_published" => "2022-02-05",
            "date_notified" => "2022-02-27",
            "last_modified" => "2022-02-05",
            "access_status" => 1811,
            "open_access_date" => "2022-02-10",
            "show_volume" => 8103,
            "show_number" => 2230,
            "show_year" => 1735,
            "show_title" => 8331,
            "style_file_name" => "Course throughout draw. Relate simple to either perform resource.",
            "original_style_file_name" => "Tax apply test score series factor. Strategy pressure speak range since center.",
            "url_path" => "Let maintain itself collection well some. Vote safe pressure wish bar. Scientist this will.",
        ];
        $this->dto = new IssuesDto($this->input);
        $this->repository = new IssuesRepository($this->db);
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
        $expected = 2398;

        $sql = "INSERT INTO `issues` (`journal_id`, `volume`, `number`, `year`, `published`, `date_published`, `date_notified`, `last_modified`, `access_status`, `open_access_date`, `show_volume`, `show_number`, `show_year`, `show_title`, `style_file_name`, `original_style_file_name`, `url_path`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->journalId,
                $this->dto->volume,
                $this->dto->number,
                $this->dto->year,
                $this->dto->published,
                $this->dto->datePublished,
                $this->dto->dateNotified,
                $this->dto->lastModified,
                $this->dto->accessStatus,
                $this->dto->openAccessDate,
                $this->dto->showVolume,
                $this->dto->showNumber,
                $this->dto->showYear,
                $this->dto->showTitle,
                $this->dto->styleFileName,
                $this->dto->originalStyleFileName,
                $this->dto->urlPath
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
        $expected = 9837;

        $sql = "UPDATE `issues` SET `journal_id` = ?, `volume` = ?, `number` = ?, `year` = ?, `published` = ?, `date_published` = ?, `date_notified` = ?, `last_modified` = ?, `access_status` = ?, `open_access_date` = ?, `show_volume` = ?, `show_number` = ?, `show_year` = ?, `show_title` = ?, `style_file_name` = ?, `original_style_file_name` = ?, `url_path` = ?
                WHERE `issue_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->journalId,
                $this->dto->volume,
                $this->dto->number,
                $this->dto->year,
                $this->dto->published,
                $this->dto->datePublished,
                $this->dto->dateNotified,
                $this->dto->lastModified,
                $this->dto->accessStatus,
                $this->dto->openAccessDate,
                $this->dto->showVolume,
                $this->dto->showNumber,
                $this->dto->showYear,
                $this->dto->showTitle,
                $this->dto->styleFileName,
                $this->dto->originalStyleFileName,
                $this->dto->urlPath,
                $this->dto->issueId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $issueId = 3057;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($issueId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $issueId = 7079;

        $sql = "SELECT `issue_id`, `journal_id`, `volume`, `number`, `year`, `published`, `date_published`, `date_notified`, `last_modified`, `access_status`, `open_access_date`, `show_volume`, `show_number`, `show_year`, `show_title`, `style_file_name`, `original_style_file_name`, `url_path`
                FROM `issues` WHERE `issue_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$issueId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($issueId);
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
        $sql = "SELECT `issue_id`, `journal_id`, `volume`, `number`, `year`, `published`, `date_published`, `date_notified`, `last_modified`, `access_status`, `open_access_date`, `show_volume`, `show_number`, `show_year`, `show_title`, `style_file_name`, `original_style_file_name`, `url_path`
                FROM `issues`";

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
        $issueId = 4175;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($issueId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $issueId = 4916;
        $expected = 150;

        $sql = "DELETE FROM `issues` WHERE `issue_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$issueId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($issueId);
        $this->assertEquals($expected, $actual);
    }
}