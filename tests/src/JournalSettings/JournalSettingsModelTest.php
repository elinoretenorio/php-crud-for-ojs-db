<?php

declare(strict_types=1);

namespace OJS\Tests\JournalSettings;

use PHPUnit\Framework\TestCase;
use OJS\JournalSettings\{ JournalSettingsDto, JournalSettingsModel };

class JournalSettingsModelTest extends TestCase
{
    private array $input;
    private JournalSettingsDto $dto;
    private JournalSettingsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "journal_setting_id" => 8182,
            "journal_id" => 2302,
            "locale" => "Pretty front others though. Case order get common. Guy fill employee drug.",
            "setting_name" => "Condition responsibility set. Discuss challenge nor employee fear their mean. Need late suggest manage difficult rate.",
            "setting_value" => "About special approach take. Lay sense evidence end white who society modern.",
            "setting_type" => "Only program within girl condition center say. Own answer knowledge.",
        ];
        $this->dto = new JournalSettingsDto($this->input);
        $this->model = new JournalSettingsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new JournalSettingsModel(null);

        $this->assertInstanceOf(JournalSettingsModel::class, $model);
    }

    public function testGetJournalSettingId(): void
    {
        $this->assertEquals($this->dto->journalSettingId, $this->model->getJournalSettingId());
    }

    public function testSetJournalSettingId(): void
    {
        $expected = 8848;
        $model = $this->model;
        $model->setJournalSettingId($expected);

        $this->assertEquals($expected, $model->getJournalSettingId());
    }

    public function testGetJournalId(): void
    {
        $this->assertEquals($this->dto->journalId, $this->model->getJournalId());
    }

    public function testSetJournalId(): void
    {
        $expected = 7068;
        $model = $this->model;
        $model->setJournalId($expected);

        $this->assertEquals($expected, $model->getJournalId());
    }

    public function testGetLocale(): void
    {
        $this->assertEquals($this->dto->locale, $this->model->getLocale());
    }

    public function testSetLocale(): void
    {
        $expected = "Sea young appear. Wife them half find mean lay must security.";
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
        $expected = "Then remain main long generation. Agreement right various notice radio be. Will long store remember action difficult system practice. Hard material dinner civil development unit decide beyond.";
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
        $expected = "Generation with right record yes among. Military politics seem important.";
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
        $expected = "Radio consider nearly speech his window peace Mrs. Add national environmental.";
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