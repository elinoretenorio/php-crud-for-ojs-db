<?php

declare(strict_types=1);

namespace OJS\Tests\CompletedPayments;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Database\DatabaseException;
use OJS\CompletedPayments\{ CompletedPaymentsDto, ICompletedPaymentsRepository, CompletedPaymentsRepository };

class CompletedPaymentsRepositoryTest extends TestCase
{
    private MockObject $db;
    private MockObject $result;
    private array $input;
    private CompletedPaymentsDto $dto;
    private ICompletedPaymentsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("OJS\Database\IDatabase");
        $this->result = $this->createMock("OJS\Database\IDatabaseResult");
        $this->input = [
            "completed_payment_id" => 702,
            "timestamp" => "2022-02-22",
            "payment_type" => 7753,
            "context_id" => 9312,
            "user_id" => 899,
            "assoc_id" => 2348,
            "amount" => 92.51,
            "currency_code_alpha" => "Certainly effort less instead off. Model entire general other better trade town.",
            "payment_method_plugin_name" => "Staff meet matter cover concern serious surface. Among wear company throughout use pressure think.",
        ];
        $this->dto = new CompletedPaymentsDto($this->input);
        $this->repository = new CompletedPaymentsRepository($this->db);
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
        $expected = 8626;

        $sql = "INSERT INTO `completed_payments` (`timestamp`, `payment_type`, `context_id`, `user_id`, `assoc_id`, `amount`, `currency_code_alpha`, `payment_method_plugin_name`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->timestamp,
                $this->dto->paymentType,
                $this->dto->contextId,
                $this->dto->userId,
                $this->dto->assocId,
                $this->dto->amount,
                $this->dto->currencyCodeAlpha,
                $this->dto->paymentMethodPluginName
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
        $expected = 9702;

        $sql = "UPDATE `completed_payments` SET `timestamp` = ?, `payment_type` = ?, `context_id` = ?, `user_id` = ?, `assoc_id` = ?, `amount` = ?, `currency_code_alpha` = ?, `payment_method_plugin_name` = ?
                WHERE `completed_payment_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->timestamp,
                $this->dto->paymentType,
                $this->dto->contextId,
                $this->dto->userId,
                $this->dto->assocId,
                $this->dto->amount,
                $this->dto->currencyCodeAlpha,
                $this->dto->paymentMethodPluginName,
                $this->dto->completedPaymentId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $completedPaymentId = 1733;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($completedPaymentId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $completedPaymentId = 4012;

        $sql = "SELECT `completed_payment_id`, `timestamp`, `payment_type`, `context_id`, `user_id`, `assoc_id`, `amount`, `currency_code_alpha`, `payment_method_plugin_name`
                FROM `completed_payments` WHERE `completed_payment_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$completedPaymentId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($completedPaymentId);
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
        $sql = "SELECT `completed_payment_id`, `timestamp`, `payment_type`, `context_id`, `user_id`, `assoc_id`, `amount`, `currency_code_alpha`, `payment_method_plugin_name`
                FROM `completed_payments`";

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
        $completedPaymentId = 5228;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($completedPaymentId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $completedPaymentId = 7896;
        $expected = 3374;

        $sql = "DELETE FROM `completed_payments` WHERE `completed_payment_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$completedPaymentId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($completedPaymentId);
        $this->assertEquals($expected, $actual);
    }
}