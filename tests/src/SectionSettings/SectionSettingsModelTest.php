<?php

declare(strict_types=1);

namespace OJS\Tests\SectionSettings;

use PHPUnit\Framework\TestCase;
use OJS\SectionSettings\{ SectionSettingsDto, SectionSettingsModel };

class SectionSettingsModelTest extends TestCase
{
    private array $input;
    private SectionSettingsDto $dto;
    private SectionSettingsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "section_setting_id" => 6481,
            "section_id" => 5725,
            "locale" => "Item write unit effect design camera rise rule. Customer health ask free. Chair increase more though daughter sell actually.",
            "setting_name" => "Begin term project maintain. Pick cut very describe across authority political.",
            "setting_value" => "Bed yes culture court network. Entire this man south section include. Message campaign work.",
            "setting_type" => "Third protect boy need. Subject consumer billion sea space deal each back.",
        ];
        $this->dto = new SectionSettingsDto($this->input);
        $this->model = new SectionSettingsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new SectionSettingsModel(null);

        $this->assertInstanceOf(SectionSettingsModel::class, $model);
    }

    public function testGetSectionSettingId(): void
    {
        $this->assertEquals($this->dto->sectionSettingId, $this->model->getSectionSettingId());
    }

    public function testSetSectionSettingId(): void
    {
        $expected = 9446;
        $model = $this->model;
        $model->setSectionSettingId($expected);

        $this->assertEquals($expected, $model->getSectionSettingId());
    }

    public function testGetSectionId(): void
    {
        $this->assertEquals($this->dto->sectionId, $this->model->getSectionId());
    }

    public function testSetSectionId(): void
    {
        $expected = 7620;
        $model = $this->model;
        $model->setSectionId($expected);

        $this->assertEquals($expected, $model->getSectionId());
    }

    public function testGetLocale(): void
    {
        $this->assertEquals($this->dto->locale, $this->model->getLocale());
    }

    public function testSetLocale(): void
    {
        $expected = "Develop last country author alone fight west morning. Offer street simply above.";
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
        $expected = "Hospital born opportunity card thousand. Scientist senior protect present second.";
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
        $expected = "Control with early. Begin field charge.";
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
        $expected = "Whatever shoulder scientist school. Call indicate news follow. Day spend beyond attention with standard among product.";
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