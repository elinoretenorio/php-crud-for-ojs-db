<?php

declare(strict_types=1);

namespace OJS\Tests\Journals;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Database\DatabaseException;
use OJS\Journals\{ JournalsDto, IJournalsRepository, JournalsRepository };

class JournalsRepositoryTest extends TestCase
{
    private MockObject $db;
    private MockObject $result;
    private array $input;
    private JournalsDto $dto;
    private IJournalsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("OJS\Database\IDatabase");
        $this->result = $this->createMock("OJS\Database\IDatabaseResult");
        $this->input = [
            "journal_id" => 3774,
            "path" => "Serve page reflect. Run summer while fast education find.",
            "seq" => 543.55,
            "primary_locale" => "Describe once could mother age reach send. Answer reveal resource or the. Character surface result whole low. Community response heart attorney pay will.",
            "enabled" => 1610,
            "current_issue_id" => 9638,
        ];
        $this->dto = new JournalsDto($this->input);
        $this->repository = new JournalsRepository($this->db);
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
        $expected = 9460;

        $sql = "INSERT INTO `journals` (`path`, `seq`, `primary_locale`, `enabled`, `current_issue_id`)
                VALUES (?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->path,
                $this->dto->seq,
                $this->dto->primaryLocale,
                $this->dto->enabled,
                $this->dto->currentIssueId
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
        $expected = 1135;

        $sql = "UPDATE `journals` SET `path` = ?, `seq` = ?, `primary_locale` = ?, `enabled` = ?, `current_issue_id` = ?
                WHERE `journal_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->path,
                $this->dto->seq,
                $this->dto->primaryLocale,
                $this->dto->enabled,
                $this->dto->currentIssueId,
                $this->dto->journalId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $journalId = 7726;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($journalId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $journalId = 9430;

        $sql = "SELECT `journal_id`, `path`, `seq`, `primary_locale`, `enabled`, `current_issue_id`
                FROM `journals` WHERE `journal_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$journalId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($journalId);
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
        $sql = "SELECT `journal_id`, `path`, `seq`, `primary_locale`, `enabled`, `current_issue_id`
                FROM `journals`";

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
        $journalId = 967;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($journalId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $journalId = 5848;
        $expected = 7045;

        $sql = "DELETE FROM `journals` WHERE `journal_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$journalId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($journalId);
        $this->assertEquals($expected, $actual);
    }
}