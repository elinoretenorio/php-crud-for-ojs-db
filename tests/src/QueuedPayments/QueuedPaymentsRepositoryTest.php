<?php

declare(strict_types=1);

namespace OJS\Tests\QueuedPayments;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Database\DatabaseException;
use OJS\QueuedPayments\{ QueuedPaymentsDto, IQueuedPaymentsRepository, QueuedPaymentsRepository };

class QueuedPaymentsRepositoryTest extends TestCase
{
    private MockObject $db;
    private MockObject $result;
    private array $input;
    private QueuedPaymentsDto $dto;
    private IQueuedPaymentsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("OJS\Database\IDatabase");
        $this->result = $this->createMock("OJS\Database\IDatabaseResult");
        $this->input = [
            "queued_payment_id" => 3075,
            "date_created" => "2022-03-02",
            "date_modified" => "2022-02-04",
            "expiry_date" => "2022-02-12",
            "payment_data" => "Change sell guess sure another TV. Participant item level everyone American quite appear room. Yeah may employee assume democratic.",
        ];
        $this->dto = new QueuedPaymentsDto($this->input);
        $this->repository = new QueuedPaymentsRepository($this->db);
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
        $expected = 1382;

        $sql = "INSERT INTO `queued_payments` (`date_created`, `date_modified`, `expiry_date`, `payment_data`)
                VALUES (?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->dateCreated,
                $this->dto->dateModified,
                $this->dto->expiryDate,
                $this->dto->paymentData
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
        $expected = 6215;

        $sql = "UPDATE `queued_payments` SET `date_created` = ?, `date_modified` = ?, `expiry_date` = ?, `payment_data` = ?
                WHERE `queued_payment_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->dateCreated,
                $this->dto->dateModified,
                $this->dto->expiryDate,
                $this->dto->paymentData,
                $this->dto->queuedPaymentId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $queuedPaymentId = 5280;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($queuedPaymentId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $queuedPaymentId = 6521;

        $sql = "SELECT `queued_payment_id`, `date_created`, `date_modified`, `expiry_date`, `payment_data`
                FROM `queued_payments` WHERE `queued_payment_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$queuedPaymentId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($queuedPaymentId);
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
        $sql = "SELECT `queued_payment_id`, `date_created`, `date_modified`, `expiry_date`, `payment_data`
                FROM `queued_payments`";

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
        $queuedPaymentId = 9438;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($queuedPaymentId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $queuedPaymentId = 780;
        $expected = 1244;

        $sql = "DELETE FROM `queued_payments` WHERE `queued_payment_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$queuedPaymentId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($queuedPaymentId);
        $this->assertEquals($expected, $actual);
    }
}