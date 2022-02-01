<?php

declare(strict_types=1);

namespace OJS\Tests\PublicationGalleySettings;

use PHPUnit\Framework\TestCase;
use OJS\PublicationGalleySettings\{ PublicationGalleySettingsDto, PublicationGalleySettingsModel };

class PublicationGalleySettingsModelTest extends TestCase
{
    private array $input;
    private PublicationGalleySettingsDto $dto;
    private PublicationGalleySettingsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "publication_galley_setting_id" => 8868,
            "galley_id" => 6688,
            "locale" => "Easy sister show sure son structure. Challenge fund action occur image fish.",
            "setting_name" => "Whose alone up war wide news especially. Indeed local mission total by. Eat edge middle.",
            "setting_value" => "Language case call detail real product wife. Card those human fast avoid drug right.",
        ];
        $this->dto = new PublicationGalleySettingsDto($this->input);
        $this->model = new PublicationGalleySettingsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new PublicationGalleySettingsModel(null);

        $this->assertInstanceOf(PublicationGalleySettingsModel::class, $model);
    }

    public function testGetPublicationGalleySettingId(): void
    {
        $this->assertEquals($this->dto->publicationGalleySettingId, $this->model->getPublicationGalleySettingId());
    }

    public function testSetPublicationGalleySettingId(): void
    {
        $expected = 5804;
        $model = $this->model;
        $model->setPublicationGalleySettingId($expected);

        $this->assertEquals($expected, $model->getPublicationGalleySettingId());
    }

    public function testGetGalleyId(): void
    {
        $this->assertEquals($this->dto->galleyId, $this->model->getGalleyId());
    }

    public function testSetGalleyId(): void
    {
        $expected = 9399;
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
        $expected = "Along week charge test pattern environment sport seem. Dog staff course interesting.";
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
        $expected = "Right food a.";
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
        $expected = "Week address including run audience film mind save. Wish speak you across above keep line. Left fact decade start along security arm.";
        $model = $this->model;
        $model->setSettingValue($expected);

        $this->assertEquals($expected, $model->getSettingValue());
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