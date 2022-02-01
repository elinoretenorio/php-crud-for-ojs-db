<?php

declare(strict_types=1);

namespace OJS\Tests\Subscriptions;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Database\DatabaseException;
use OJS\Subscriptions\{ SubscriptionsDto, ISubscriptionsRepository, SubscriptionsRepository };

class SubscriptionsRepositoryTest extends TestCase
{
    private MockObject $db;
    private MockObject $result;
    private array $input;
    private SubscriptionsDto $dto;
    private ISubscriptionsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("OJS\Database\IDatabase");
        $this->result = $this->createMock("OJS\Database\IDatabaseResult");
        $this->input = [
            "subscription_id" => 2679,
            "journal_id" => 3058,
            "user_id" => 3159,
            "type_id" => 200,
            "date_start" => "2022-02-13",
            "date_end" => "2022-02-15",
            "status" => 2450,
            "membership" => "Effect money suffer mention process. Well career seat moment consider. Present now can ever.",
            "reference_number" => "Teacher cultural describe throughout save more career. Civil performance share amount table agree. Expert black involve where religious other.",
            "notes" => "Treat attention indeed through. Explain general this close long.",
        ];
        $this->dto = new SubscriptionsDto($this->input);
        $this->repository = new SubscriptionsRepository($this->db);
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
        $expected = 7813;

        $sql = "INSERT INTO `subscriptions` (`journal_id`, `user_id`, `type_id`, `date_start`, `date_end`, `status`, `membership`, `reference_number`, `notes`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->journalId,
                $this->dto->userId,
                $this->dto->typeId,
                $this->dto->dateStart,
                $this->dto->dateEnd,
                $this->dto->status,
                $this->dto->membership,
                $this->dto->referenceNumber,
                $this->dto->notes
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
        $expected = 4806;

        $sql = "UPDATE `subscriptions` SET `journal_id` = ?, `user_id` = ?, `type_id` = ?, `date_start` = ?, `date_end` = ?, `status` = ?, `membership` = ?, `reference_number` = ?, `notes` = ?
                WHERE `subscription_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->journalId,
                $this->dto->userId,
                $this->dto->typeId,
                $this->dto->dateStart,
                $this->dto->dateEnd,
                $this->dto->status,
                $this->dto->membership,
                $this->dto->referenceNumber,
                $this->dto->notes,
                $this->dto->subscriptionId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $subscriptionId = 7839;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($subscriptionId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $subscriptionId = 6862;

        $sql = "SELECT `subscription_id`, `journal_id`, `user_id`, `type_id`, `date_start`, `date_end`, `status`, `membership`, `reference_number`, `notes`
                FROM `subscriptions` WHERE `subscription_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$subscriptionId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($subscriptionId);
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
        $sql = "SELECT `subscription_id`, `journal_id`, `user_id`, `type_id`, `date_start`, `date_end`, `status`, `membership`, `reference_number`, `notes`
                FROM `subscriptions`";

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
        $subscriptionId = 3265;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($subscriptionId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $subscriptionId = 7134;
        $expected = 3898;

        $sql = "DELETE FROM `subscriptions` WHERE `subscription_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$subscriptionId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($subscriptionId);
        $this->assertEquals($expected, $actual);
    }
}