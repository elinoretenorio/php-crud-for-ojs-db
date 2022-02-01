<?php

declare(strict_types=1);

namespace OJS\Tests\InstitutionalSubscriptionIp;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Database\DatabaseException;
use OJS\InstitutionalSubscriptionIp\{ InstitutionalSubscriptionIpDto, IInstitutionalSubscriptionIpRepository, InstitutionalSubscriptionIpRepository };

class InstitutionalSubscriptionIpRepositoryTest extends TestCase
{
    private MockObject $db;
    private MockObject $result;
    private array $input;
    private InstitutionalSubscriptionIpDto $dto;
    private IInstitutionalSubscriptionIpRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("OJS\Database\IDatabase");
        $this->result = $this->createMock("OJS\Database\IDatabaseResult");
        $this->input = [
            "institutional_subscription_ip_id" => 5778,
            "subscription_id" => 8319,
            "ip_string" => "Pretty head air less car. Production top interview. Option give floor ask it attorney opportunity.",
            "ip_start" => 566,
            "ip_end" => 1082,
        ];
        $this->dto = new InstitutionalSubscriptionIpDto($this->input);
        $this->repository = new InstitutionalSubscriptionIpRepository($this->db);
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
        $expected = 4396;

        $sql = "INSERT INTO `institutional_subscription_ip` (`subscription_id`, `ip_string`, `ip_start`, `ip_end`)
                VALUES (?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->subscriptionId,
                $this->dto->ipString,
                $this->dto->ipStart,
                $this->dto->ipEnd
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
        $expected = 4229;

        $sql = "UPDATE `institutional_subscription_ip` SET `subscription_id` = ?, `ip_string` = ?, `ip_start` = ?, `ip_end` = ?
                WHERE `institutional_subscription_ip_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->subscriptionId,
                $this->dto->ipString,
                $this->dto->ipStart,
                $this->dto->ipEnd,
                $this->dto->institutionalSubscriptionIpId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $institutionalSubscriptionIpId = 6661;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($institutionalSubscriptionIpId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $institutionalSubscriptionIpId = 1117;

        $sql = "SELECT `institutional_subscription_ip_id`, `subscription_id`, `ip_string`, `ip_start`, `ip_end`
                FROM `institutional_subscription_ip` WHERE `institutional_subscription_ip_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$institutionalSubscriptionIpId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($institutionalSubscriptionIpId);
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
        $sql = "SELECT `institutional_subscription_ip_id`, `subscription_id`, `ip_string`, `ip_start`, `ip_end`
                FROM `institutional_subscription_ip`";

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
        $institutionalSubscriptionIpId = 7048;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($institutionalSubscriptionIpId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $institutionalSubscriptionIpId = 5419;
        $expected = 3879;

        $sql = "DELETE FROM `institutional_subscription_ip` WHERE `institutional_subscription_ip_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$institutionalSubscriptionIpId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($institutionalSubscriptionIpId);
        $this->assertEquals($expected, $actual);
    }
}