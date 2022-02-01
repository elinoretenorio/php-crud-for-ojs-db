<?php

declare(strict_types=1);

namespace OJS\Tests\InstitutionalSubscriptions;

use PHPUnit\Framework\TestCase;
use OJS\InstitutionalSubscriptions\{ InstitutionalSubscriptionsDto, InstitutionalSubscriptionsModel };

class InstitutionalSubscriptionsModelTest extends TestCase
{
    private array $input;
    private InstitutionalSubscriptionsDto $dto;
    private InstitutionalSubscriptionsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "institutional_subscription_id" => 5174,
            "subscription_id" => 5742,
            "institution_name" => "Seem several worry real.",
            "mailing_address" => "Bad probably friend reason drop mind dark. Model civil region above worry sit.",
            "domain" => "Four from since way fast real large upon. Their meet machine media. By even area indeed. Agree soon turn discussion take.",
        ];
        $this->dto = new InstitutionalSubscriptionsDto($this->input);
        $this->model = new InstitutionalSubscriptionsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new InstitutionalSubscriptionsModel(null);

        $this->assertInstanceOf(InstitutionalSubscriptionsModel::class, $model);
    }

    public function testGetInstitutionalSubscriptionId(): void
    {
        $this->assertEquals($this->dto->institutionalSubscriptionId, $this->model->getInstitutionalSubscriptionId());
    }

    public function testSetInstitutionalSubscriptionId(): void
    {
        $expected = 8923;
        $model = $this->model;
        $model->setInstitutionalSubscriptionId($expected);

        $this->assertEquals($expected, $model->getInstitutionalSubscriptionId());
    }

    public function testGetSubscriptionId(): void
    {
        $this->assertEquals($this->dto->subscriptionId, $this->model->getSubscriptionId());
    }

    public function testSetSubscriptionId(): void
    {
        $expected = 5365;
        $model = $this->model;
        $model->setSubscriptionId($expected);

        $this->assertEquals($expected, $model->getSubscriptionId());
    }

    public function testGetInstitutionName(): void
    {
        $this->assertEquals($this->dto->institutionName, $this->model->getInstitutionName());
    }

    public function testSetInstitutionName(): void
    {
        $expected = "There store tough. Possible wife senior Republican or. Particularly another whom baby whose fact drug likely.";
        $model = $this->model;
        $model->setInstitutionName($expected);

        $this->assertEquals($expected, $model->getInstitutionName());
    }

    public function testGetMailingAddress(): void
    {
        $this->assertEquals($this->dto->mailingAddress, $this->model->getMailingAddress());
    }

    public function testSetMailingAddress(): void
    {
        $expected = "Know change weight after product your. Onto amount much food.";
        $model = $this->model;
        $model->setMailingAddress($expected);

        $this->assertEquals($expected, $model->getMailingAddress());
    }

    public function testGetDomain(): void
    {
        $this->assertEquals($this->dto->domain, $this->model->getDomain());
    }

    public function testSetDomain(): void
    {
        $expected = "Skill music may reduce eat become. Home hot assume memory a give. Trip land here state baby. Almost left special term trial be.";
        $model = $this->model;
        $model->setDomain($expected);

        $this->assertEquals($expected, $model->getDomain());
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