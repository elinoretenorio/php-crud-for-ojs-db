<?php

declare(strict_types=1);

namespace OJS\Tests\InstitutionalSubscriptions;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Database\DatabaseException;
use OJS\InstitutionalSubscriptions\{ InstitutionalSubscriptionsDto, IInstitutionalSubscriptionsRepository, InstitutionalSubscriptionsRepository };

class InstitutionalSubscriptionsRepositoryTest extends TestCase
{
    private MockObject $db;
    private MockObject $result;
    private array $input;
    private InstitutionalSubscriptionsDto $dto;
    private IInstitutionalSubscriptionsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("OJS\Database\IDatabase");
        $this->result = $this->createMock("OJS\Database\IDatabaseResult");
        $this->input = [
            "institutional_subscription_id" => 5464,
            "subscription_id" => 9308,
            "institution_name" => "Me firm commercial item he key light sound. Something democratic whom north. Character enter nice have father.",
            "mailing_address" => "Old science follow war member. Newspaper radio news could. Person let through team course.",
            "domain" => "Investment be when spring computer drug. Ago learn front car third want street. Key two discuss represent return.",
        ];
        $this->dto = new InstitutionalSubscriptionsDto($this->input);
        $this->repository = new InstitutionalSubscriptionsRepository($this->db);
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
        $expected = 3152;

        $sql = "INSERT INTO `institutional_subscriptions` (`subscription_id`, `institution_name`, `mailing_address`, `domain`)
                VALUES (?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->subscriptionId,
                $this->dto->institutionName,
                $this->dto->mailingAddress,
                $this->dto->domain
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
        $expected = 6089;

        $sql = "UPDATE `institutional_subscriptions` SET `subscription_id` = ?, `institution_name` = ?, `mailing_address` = ?, `domain` = ?
                WHERE `institutional_subscription_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->subscriptionId,
                $this->dto->institutionName,
                $this->dto->mailingAddress,
                $this->dto->domain,
                $this->dto->institutionalSubscriptionId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $institutionalSubscriptionId = 5824;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($institutionalSubscriptionId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $institutionalSubscriptionId = 4417;

        $sql = "SELECT `institutional_subscription_id`, `subscription_id`, `institution_name`, `mailing_address`, `domain`
                FROM `institutional_subscriptions` WHERE `institutional_subscription_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$institutionalSubscriptionId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($institutionalSubscriptionId);
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
        $sql = "SELECT `institutional_subscription_id`, `subscription_id`, `institution_name`, `mailing_address`, `domain`
                FROM `institutional_subscriptions`";

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
        $institutionalSubscriptionId = 5656;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($institutionalSubscriptionId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $institutionalSubscriptionId = 6613;
        $expected = 146;

        $sql = "DELETE FROM `institutional_subscriptions` WHERE `institutional_subscription_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$institutionalSubscriptionId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($institutionalSubscriptionId);
        $this->assertEquals($expected, $actual);
    }
}