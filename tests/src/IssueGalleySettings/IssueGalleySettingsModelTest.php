<?php

declare(strict_types=1);

namespace OJS\Tests\IssueGalleySettings;

use PHPUnit\Framework\TestCase;
use OJS\IssueGalleySettings\{ IssueGalleySettingsDto, IssueGalleySettingsModel };

class IssueGalleySettingsModelTest extends TestCase
{
    private array $input;
    private IssueGalleySettingsDto $dto;
    private IssueGalleySettingsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "issue_galley_setting_id" => 5980,
            "galley_id" => 692,
            "locale" => "Concern determine store network paper tree. Field third ago scene. Nation day music draw could usually allow.",
            "setting_name" => "World beat nice truth. Staff let economy option room meeting player.",
            "setting_value" => "Example raise chance treatment final avoid.",
            "setting_type" => "Environment fire particularly pass. Street street fight building significant sit. Focus everyone run mother.",
        ];
        $this->dto = new IssueGalleySettingsDto($this->input);
        $this->model = new IssueGalleySettingsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new IssueGalleySettingsModel(null);

        $this->assertInstanceOf(IssueGalleySettingsModel::class, $model);
    }

    public function testGetIssueGalleySettingId(): void
    {
        $this->assertEquals($this->dto->issueGalleySettingId, $this->model->getIssueGalleySettingId());
    }

    public function testSetIssueGalleySettingId(): void
    {
        $expected = 2749;
        $model = $this->model;
        $model->setIssueGalleySettingId($expected);

        $this->assertEquals($expected, $model->getIssueGalleySettingId());
    }

    public function testGetGalleyId(): void
    {
        $this->assertEquals($this->dto->galleyId, $this->model->getGalleyId());
    }

    public function testSetGalleyId(): void
    {
        $expected = 6422;
        $model = $this->model;
        $model->setGalleyId($expected);

        $this->assertEquals($expected, $model->getGalleyId());
    }

    public function testGetLocale(): void
    {
        $this->assertEquals($this->dto->locale, $this->model->getLocale());
    }

    public function testSetLocale(): void
    {
        $expected = "Officer picture find million their career air upon. Feeling decade certain activity rest parent onto.";
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
        $expected = "Friend job agency painting. Together man rise type skin.";
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
        $expected = "Through firm green sport born although rule. Certainly account already process hand lead sound.";
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
        $expected = "Between air travel reflect dinner. Hundred see later whether.";
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