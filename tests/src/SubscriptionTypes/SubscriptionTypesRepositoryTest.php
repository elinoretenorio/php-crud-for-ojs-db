<?php

declare(strict_types=1);

namespace OJS\Tests\SubscriptionTypes;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Database\DatabaseException;
use OJS\SubscriptionTypes\{ SubscriptionTypesDto, ISubscriptionTypesRepository, SubscriptionTypesRepository };

class SubscriptionTypesRepositoryTest extends TestCase
{
    private MockObject $db;
    private MockObject $result;
    private array $input;
    private SubscriptionTypesDto $dto;
    private ISubscriptionTypesRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("OJS\Database\IDatabase");
        $this->result = $this->createMock("OJS\Database\IDatabaseResult");
        $this->input = [
            "type_id" => 6676,
            "journal_id" => 5706,
            "cost" => 179.44,
            "currency_code_alpha" => "Number field himself popular return. Per today five officer. Church method new home allow determine whom.",
            "duration" => 9973,
            "format" => 1290,
            "institutional" => 6315,
            "membership" => 5700,
            "disable_public_display" => 7650,
            "seq" => 823.28,
        ];
        $this->dto = new SubscriptionTypesDto($this->input);
        $this->repository = new SubscriptionTypesRepository($this->db);
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
        $expected = 7738;

        $sql = "INSERT INTO `subscription_types` (`journal_id`, `cost`, `currency_code_alpha`, `duration`, `format`, `institutional`, `membership`, `disable_public_display`, `seq`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->journalId,
                $this->dto->cost,
                $this->dto->currencyCodeAlpha,
                $this->dto->duration,
                $this->dto->format,
                $this->dto->institutional,
                $this->dto->membership,
                $this->dto->disablePublicDisplay,
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
        $expected = 8003;

        $sql = "UPDATE `subscription_types` SET `journal_id` = ?, `cost` = ?, `currency_code_alpha` = ?, `duration` = ?, `format` = ?, `institutional` = ?, `membership` = ?, `disable_public_display` = ?, `seq` = ?
                WHERE `type_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->journalId,
                $this->dto->cost,
                $this->dto->currencyCodeAlpha,
                $this->dto->duration,
                $this->dto->format,
                $this->dto->institutional,
                $this->dto->membership,
                $this->dto->disablePublicDisplay,
                $this->dto->seq,
                $this->dto->typeId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $typeId = 9631;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($typeId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $typeId = 2320;

        $sql = "SELECT `type_id`, `journal_id`, `cost`, `currency_code_alpha`, `duration`, `format`, `institutional`, `membership`, `disable_public_display`, `seq`
                FROM `subscription_types` WHERE `type_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$typeId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($typeId);
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
        $sql = "SELECT `type_id`, `journal_id`, `cost`, `currency_code_alpha`, `duration`, `format`, `institutional`, `membership`, `disable_public_display`, `seq`
                FROM `subscription_types`";

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
        $typeId = 7182;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($typeId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $typeId = 2116;
        $expected = 7882;

        $sql = "DELETE FROM `subscription_types` WHERE `type_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$typeId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($typeId);
        $this->assertEquals($expected, $actual);
    }
}