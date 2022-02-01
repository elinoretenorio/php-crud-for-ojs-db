<?php

declare(strict_types=1);

namespace OJS\Tests\CustomIssueOrders;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Database\DatabaseException;
use OJS\CustomIssueOrders\{ CustomIssueOrdersDto, ICustomIssueOrdersRepository, CustomIssueOrdersRepository };

class CustomIssueOrdersRepositoryTest extends TestCase
{
    private MockObject $db;
    private MockObject $result;
    private array $input;
    private CustomIssueOrdersDto $dto;
    private ICustomIssueOrdersRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("OJS\Database\IDatabase");
        $this->result = $this->createMock("OJS\Database\IDatabaseResult");
        $this->input = [
            "custom_issue_order_id" => 2127,
            "issue_id" => 3596,
            "journal_id" => 5338,
            "seq" => 280.70,
        ];
        $this->dto = new CustomIssueOrdersDto($this->input);
        $this->repository = new CustomIssueOrdersRepository($this->db);
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
        $expected = 1897;

        $sql = "INSERT INTO `custom_issue_orders` (`issue_id`, `journal_id`, `seq`)
                VALUES (?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->issueId,
                $this->dto->journalId,
                $this->dto->seq
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
        $expected = 9969;

        $sql = "UPDATE `custom_issue_orders` SET `issue_id` = ?, `journal_id` = ?, `seq` = ?
                WHERE `custom_issue_order_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->issueId,
                $this->dto->journalId,
                $this->dto->seq,
                $this->dto->customIssueOrderId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $customIssueOrderId = 5019;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($customIssueOrderId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $customIssueOrderId = 1473;

        $sql = "SELECT `custom_issue_order_id`, `issue_id`, `journal_id`, `seq`
                FROM `custom_issue_orders` WHERE `custom_issue_order_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$customIssueOrderId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($customIssueOrderId);
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
        $sql = "SELECT `custom_issue_order_id`, `issue_id`, `journal_id`, `seq`
                FROM `custom_issue_orders`";

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
        $customIssueOrderId = 8780;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($customIssueOrderId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $customIssueOrderId = 2246;
        $expected = 9924;

        $sql = "DELETE FROM `custom_issue_orders` WHERE `custom_issue_order_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$customIssueOrderId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($customIssueOrderId);
        $this->assertEquals($expected, $actual);
    }
}