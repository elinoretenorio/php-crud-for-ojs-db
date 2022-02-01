<?php

declare(strict_types=1);

namespace OJS\Tests\IssueGalleys;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Database\DatabaseException;
use OJS\IssueGalleys\{ IssueGalleysDto, IIssueGalleysRepository, IssueGalleysRepository };

class IssueGalleysRepositoryTest extends TestCase
{
    private MockObject $db;
    private MockObject $result;
    private array $input;
    private IssueGalleysDto $dto;
    private IIssueGalleysRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("OJS\Database\IDatabase");
        $this->result = $this->createMock("OJS\Database\IDatabaseResult");
        $this->input = [
            "galley_id" => 4199,
            "locale" => "Management ever itself travel pattern. Raise training same.",
            "issue_id" => 800,
            "file_id" => 3936,
            "label" => "Return certainly wish cost can eight. Glass step type agreement. Wonder job sell experience reason perhaps.",
            "seq" => 616.20,
            "url_path" => "Sense skill design game name. Identify true ever. Close style plan age.",
        ];
        $this->dto = new IssueGalleysDto($this->input);
        $this->repository = new IssueGalleysRepository($this->db);
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
        $expected = 5435;

        $sql = "INSERT INTO `issue_galleys` (`locale`, `issue_id`, `file_id`, `label`, `seq`, `url_path`)
                VALUES (?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->locale,
                $this->dto->issueId,
                $this->dto->fileId,
                $this->dto->label,
                $this->dto->seq,
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
        $expected = 9785;

        $sql = "UPDATE `issue_galleys` SET `locale` = ?, `issue_id` = ?, `file_id` = ?, `label` = ?, `seq` = ?, `url_path` = ?
                WHERE `galley_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->locale,
                $this->dto->issueId,
                $this->dto->fileId,
                $this->dto->label,
                $this->dto->seq,
                $this->dto->urlPath,
                $this->dto->galleyId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $galleyId = 7388;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($galleyId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $galleyId = 1501;

        $sql = "SELECT `galley_id`, `locale`, `issue_id`, `file_id`, `label`, `seq`, `url_path`
                FROM `issue_galleys` WHERE `galley_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$galleyId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($galleyId);
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
        $sql = "SELECT `galley_id`, `locale`, `issue_id`, `file_id`, `label`, `seq`, `url_path`
                FROM `issue_galleys`";

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
        $galleyId = 4466;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($galleyId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $galleyId = 751;
        $expected = 2341;

        $sql = "DELETE FROM `issue_galleys` WHERE `galley_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$galleyId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($galleyId);
        $this->assertEquals($expected, $actual);
    }
}