<?php

declare(strict_types=1);

namespace OJS\Tests\SectionSettings;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Database\DatabaseException;
use OJS\SectionSettings\{ SectionSettingsDto, ISectionSettingsRepository, SectionSettingsRepository };

class SectionSettingsRepositoryTest extends TestCase
{
    private MockObject $db;
    private MockObject $result;
    private array $input;
    private SectionSettingsDto $dto;
    private ISectionSettingsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("OJS\Database\IDatabase");
        $this->result = $this->createMock("OJS\Database\IDatabaseResult");
        $this->input = [
            "section_setting_id" => 7082,
            "section_id" => 1707,
            "locale" => "General its actually main beautiful language. These others article sense grow. There remember beautiful camera wish. Former kind chance south answer summer month collection.",
            "setting_name" => "Yourself though might general. Find instead prove building woman low world. Always discuss yard.",
            "setting_value" => "Floor paper important seem million. Simply sea only question according recognize.",
            "setting_type" => "Factor may huge kind interest manager. Technology region upon however. Money none especially long.",
        ];
        $this->dto = new SectionSettingsDto($this->input);
        $this->repository = new SectionSettingsRepository($this->db);
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
        $expected = 5023;

        $sql = "INSERT INTO `section_settings` (`section_id`, `locale`, `setting_name`, `setting_value`, `setting_type`)
                VALUES (?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->sectionId,
                $this->dto->locale,
                $this->dto->settingName,
                $this->dto->settingValue,
                $this->dto->settingType
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
        $expected = 6007;

        $sql = "UPDATE `section_settings` SET `section_id` = ?, `locale` = ?, `setting_name` = ?, `setting_value` = ?, `setting_type` = ?
                WHERE `section_setting_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->sectionId,
                $this->dto->locale,
                $this->dto->settingName,
                $this->dto->settingValue,
                $this->dto->settingType,
                $this->dto->sectionSettingId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $sectionSettingId = 8249;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($sectionSettingId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $sectionSettingId = 1423;

        $sql = "SELECT `section_setting_id`, `section_id`, `locale`, `setting_name`, `setting_value`, `setting_type`
                FROM `section_settings` WHERE `section_setting_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$sectionSettingId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($sectionSettingId);
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
        $sql = "SELECT `section_setting_id`, `section_id`, `locale`, `setting_name`, `setting_value`, `setting_type`
                FROM `section_settings`";

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
        $sectionSettingId = 1656;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($sectionSettingId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $sectionSettingId = 4484;
        $expected = 1280;

        $sql = "DELETE FROM `section_settings` WHERE `section_setting_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$sectionSettingId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($sectionSettingId);
        $this->assertEquals($expected, $actual);
    }
}