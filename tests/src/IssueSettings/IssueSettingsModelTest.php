<?php

declare(strict_types=1);

namespace OJS\Tests\IssueSettings;

use PHPUnit\Framework\TestCase;
use OJS\IssueSettings\{ IssueSettingsDto, IssueSettingsModel };

class IssueSettingsModelTest extends TestCase
{
    private array $input;
    private IssueSettingsDto $dto;
    private IssueSettingsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "issue_setting_id" => 4578,
            "issue_id" => 1627,
            "locale" => "Let college development production seven place easy. Summer week concern game see. Rule able likely white nation.",
            "setting_name" => "Natural physical of space man. Improve great win body either brother good.",
            "setting_value" => "Training opportunity contain respond senior kid its they.",
            "setting_type" => "Be apply serious affect. Start institution lose easy reveal structure require.",
        ];
        $this->dto = new IssueSettingsDto($this->input);
        $this->model = new IssueSettingsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new IssueSettingsModel(null);

        $this->assertInstanceOf(IssueSettingsModel::class, $model);
    }

    public function testGetIssueSettingId(): void
    {
        $this->assertEquals($this->dto->issueSettingId, $this->model->getIssueSettingId());
    }

    public function testSetIssueSettingId(): void
    {
        $expected = 1765;
        $model = $this->model;
        $model->setIssueSettingId($expected);

        $this->assertEquals($expected, $model->getIssueSettingId());
    }

    public function testGetIssueId(): void
    {
        $this->assertEquals($this->dto->issueId, $this->model->getIssueId());
    }

    public function testSetIssueId(): void
    {
        $expected = 3728;
        $model = $this->model;
        $model->setIssueId($expected);

        $this->assertEquals($expected, $model->getIssueId());
    }

    public function testGetLocale(): void
    {
        $this->assertEquals($this->dto->locale, $this->model->getLocale());
    }

    public function testSetLocale(): void
    {
        $expected = "Save stop message able. War which decide one very recently.";
        $model = $this->model;
        $model->setLocale($expected);

        $this->assertEquals($expected, $model->getLocale());
    }

    public function testGetSettingName(): void
    {
        $this->assertEquals($this->dto->settingName, $this->model->getSettingName());
    }

    public function testSetSettingName(): void
    {
        $expected = "Mr oil grow accept. Professor while government interest boy guy blue history.";
        $model = $this->model;
        $model->setSettingName($expected);

        $this->assertEquals($expected, $model->getSettingName());
    }

    public function testGetSettingValue(): void
    {
        $this->assertEquals($this->dto->settingValue, $this->model->getSettingValue());
    }

    public function testSetSettingValue(): void
    {
        $expected = "Type our everyone long. Program reduce possible. Part prepare where them before specific.";
        $model = $this->model;
        $model->setSettingValue($expected);

        $this->assertEquals($expected, $model->getSettingValue());
    }

    public function testGetSettingType(): void
    {
        $this->assertEquals($this->dto->settingType, $this->model->getSettingType());
    }

    public function testSetSettingType(): void
    {
        $expected = "Their agree true audience her measure. House me south across contain form. Step investment rather.";
        $model = $this->model;
        $model->setSettingType($expected);

        $this->assertEquals($expected, $model->getSettingType());
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