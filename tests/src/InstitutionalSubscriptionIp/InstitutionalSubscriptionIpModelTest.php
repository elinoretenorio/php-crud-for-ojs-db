<?php

declare(strict_types=1);

namespace OJS\Tests\InstitutionalSubscriptionIp;

use PHPUnit\Framework\TestCase;
use OJS\InstitutionalSubscriptionIp\{ InstitutionalSubscriptionIpDto, InstitutionalSubscriptionIpModel };

class InstitutionalSubscriptionIpModelTest extends TestCase
{
    private array $input;
    private InstitutionalSubscriptionIpDto $dto;
    private InstitutionalSubscriptionIpModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "institutional_subscription_ip_id" => 9034,
            "subscription_id" => 4494,
            "ip_string" => "Song up customer get. Financial situation lay these our.",
            "ip_start" => 4940,
            "ip_end" => 881,
        ];
        $this->dto = new InstitutionalSubscriptionIpDto($this->input);
        $this->model = new InstitutionalSubscriptionIpModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new InstitutionalSubscriptionIpModel(null);

        $this->assertInstanceOf(InstitutionalSubscriptionIpModel::class, $model);
    }

    public function testGetInstitutionalSubscriptionIpId(): void
    {
        $this->assertEquals($this->dto->institutionalSubscriptionIpId, $this->model->getInstitutionalSubscriptionIpId());
    }

    public function testSetInstitutionalSubscriptionIpId(): void
    {
        $expected = 4205;
        $model = $this->model;
        $model->setInstitutionalSubscriptionIpId($expected);

        $this->assertEquals($expected, $model->getInstitutionalSubscriptionIpId());
    }

    public function testGetSubscriptionId(): void
    {
        $this->assertEquals($this->dto->subscriptionId, $this->model->getSubscriptionId());
    }

    public function testSetSubscriptionId(): void
    {
        $expected = 3315;
        $model = $this->model;
        $model->setSubscriptionId($expected);

        $this->assertEquals($expected, $model->getSubscriptionId());
    }

    public function testGetIpString(): void
    {
        $this->assertEquals($this->dto->ipString, $this->model->getIpString());
    }

    public function testSetIpString(): void
    {
        $expected = "Choose item three religious listen between. Perhaps under eight also movie significant behavior.";
        $model = $this->model;
        $model->setIpString($expected);

        $this->assertEquals($expected, $model->getIpString());
    }

    public function testGetIpStart(): void
    {
        $this->assertEquals($this->dto->ipStart, $this->model->getIpStart());
    }

    public function testSetIpStart(): void
    {
        $expected = 9629;
        $model = $this->model;
        $model->setIpStart($expected);

        $this->assertEquals($expected, $model->getIpStart());
    }

    public function testGetIpEnd(): void
    {
        $this->assertEquals($this->dto->ipEnd, $this->model->getIpEnd());
    }

    public function testSetIpEnd(): void
    {
        $expected = 7867;
        $model = $this->model;
        $model->setIpEnd($expected);

        $this->assertEquals($expected, $model->getIpEnd());
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