<?php

declare(strict_types=1);

namespace OJS\Tests\Subscriptions;

use PHPUnit\Framework\TestCase;
use OJS\Subscriptions\{ SubscriptionsDto, SubscriptionsModel };

class SubscriptionsModelTest extends TestCase
{
    private array $input;
    private SubscriptionsDto $dto;
    private SubscriptionsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "subscription_id" => 2124,
            "journal_id" => 3705,
            "user_id" => 1965,
            "type_id" => 5364,
            "date_start" => "2022-02-12",
            "date_end" => "2022-02-22",
            "status" => 8938,
            "membership" => "Media administration surface political card memory see. Hope part enter. Environmental or include open third special. Me sing public list tree.",
            "reference_number" => "Prepare past over chair against rate. Meeting others strong bag. Evidence through explain common.",
            "notes" => "Make include agent us item draw usually. Think anyone catch drive reason.",
        ];
        $this->dto = new SubscriptionsDto($this->input);
        $this->model = new SubscriptionsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new SubscriptionsModel(null);

        $this->assertInstanceOf(SubscriptionsModel::class, $model);
    }

    public function testGetSubscriptionId(): void
    {
        $this->assertEquals($this->dto->subscriptionId, $this->model->getSubscriptionId());
    }

    public function testSetSubscriptionId(): void
    {
        $expected = 2883;
        $model = $this->model;
        $model->setSubscriptionId($expected);

        $this->assertEquals($expected, $model->getSubscriptionId());
    }

    public function testGetJournalId(): void
    {
        $this->assertEquals($this->dto->journalId, $this->model->getJournalId());
    }

    public function testSetJournalId(): void
    {
        $expected = 6287;
        $model = $this->model;
        $model->setJournalId($expected);

        $this->assertEquals($expected, $model->getJournalId());
    }

    public function testGetUserId(): void
    {
        $this->assertEquals($this->dto->userId, $this->model->getUserId());
    }

    public function testSetUserId(): void
    {
        $expected = 4500;
        $model = $this->model;
        $model->setUserId($expected);

        $this->assertEquals($expected, $model->getUserId());
    }

    public function testGetTypeId(): void
    {
        $this->assertEquals($this->dto->typeId, $this->model->getTypeId());
    }

    public function testSetTypeId(): void
    {
        $expected = 8881;
        $model = $this->model;
        $model->setTypeId($expected);

        $this->assertEquals($expected, $model->getTypeId());
    }

    public function testGetDateStart(): void
    {
        $this->assertEquals($this->dto->dateStart, $this->model->getDateStart());
    }

    public function testSetDateStart(): void
    {
        $expected = "2022-02-12";
        $model = $this->model;
        $model->setDateStart($expected);

        $this->assertEquals($expected, $model->getDateStart());
    }

    public function testGetDateEnd(): void
    {
        $this->assertEquals($this->dto->dateEnd, $this->model->getDateEnd());
    }

    public function testSetDateEnd(): void
    {
        $expected = "2022-02-15";
        $model = $this->model;
        $model->setDateEnd($expected);

        $this->assertEquals($expected, $model->getDateEnd());
    }

    public function testGetStatus(): void
    {
        $this->assertEquals($this->dto->status, $this->model->getStatus());
    }

    public function testSetStatus(): void
    {
        $expected = 3917;
        $model = $this->model;
        $model->setStatus($expected);

        $this->assertEquals($expected, $model->getStatus());
    }

    public function testGetMembership(): void
    {
        $this->assertEquals($this->dto->membership, $this->model->getMembership());
    }

    public function testSetMembership(): void
    {
        $expected = "Sell although father executive life. Language hope they build word deep successful.";
        $model = $this->model;
        $model->setMembership($expected);

        $this->assertEquals($expected, $model->getMembership());
    }

    public function testGetReferenceNumber(): void
    {
        $this->assertEquals($this->dto->referenceNumber, $this->model->getReferenceNumber());
    }

    public function testSetReferenceNumber(): void
    {
        $expected = "Foreign science nearly or mean suddenly. Four organization direction design peace. Example fly grow piece modern main southern. Believe system check man peace book deep.";
        $model = $this->model;
        $model->setReferenceNumber($expected);

        $this->assertEquals($expected, $model->getReferenceNumber());
    }

    public function testGetNotes(): void
    {
        $this->assertEquals($this->dto->notes, $this->model->getNotes());
    }

    public function testSetNotes(): void
    {
        $expected = "Language age future start kid hear soldier. Short near specific foreign role police for.";
        $model = $this->model;
        $model->setNotes($expected);

        $this->assertEquals($expected, $model->getNotes());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}