<?php

declare(strict_types=1);

namespace OJS\Tests\JournalSettings;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Database\DatabaseException;
use OJS\JournalSettings\{ JournalSettingsDto, IJournalSettingsRepository, JournalSettingsRepository };

class JournalSettingsRepositoryTest extends TestCase
{
    private MockObject $db;
    private MockObject $result;
    private array $input;
    private JournalSettingsDto $dto;
    private IJournalSettingsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("OJS\Database\IDatabase");
        $this->result = $this->createMock("OJS\Database\IDatabaseResult");
        $this->input = [
            "journal_setting_id" => 5323,
            "journal_id" => 1193,
            "locale" => "Author similar everybody stand garden later fill car. Worry line forget list.",
            "setting_name" => "Couple fight if PM do work computer. Make great network city discuss.",
            "setting_value" => "National think simple industry. Ask from should she citizen reveal always quickly. These guess get increase newspaper.",
            "setting_type" => "Around movement father choice level officer. Them interesting name would operation perhaps. Way start number point image.",
        ];
        $this->dto = new JournalSettingsDto($this->input);
        $this->repository = new JournalSettingsRepository($this->db);
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
        $expected = 1647;

        $sql = "INSERT INTO `journal_settings` (`journal_id`, `locale`, `setting_name`, `setting_value`, `setting_type`)
                VALUES (?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->journalId,
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
        $expected = 3445;

        $sql = "UPDATE `journal_settings` SET `journal_id` = ?, `locale` = ?, `setting_name` = ?, `setting_value` = ?, `setting_type` = ?
                WHERE `journal_setting_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->journalId,
                $this->dto->locale,
                $this->dto->settingName,
                $this->dto->settingValue,
                $this->dto->settingType,
                $this->dto->journalSettingId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $journalSettingId = 3613;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($journalSettingId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $journalSettingId = 834;

        $sql = "SELECT `journal_setting_id`, `journal_id`, `locale`, `setting_name`, `setting_value`, `setting_type`
                FROM `journal_settings` WHERE `journal_setting_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$journalSettingId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($journalSettingId);
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
        $sql = "SELECT `journal_setting_id`, `journal_id`, `locale`, `setting_name`, `setting_value`, `setting_type`
                FROM `journal_settings`";

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
        $journalSettingId = 8168;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($journalSettingId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $journalSettingId = 2510;
        $expected = 9137;

        $sql = "DELETE FROM `journal_settings` WHERE `journal_setting_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$journalSettingId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($journalSettingId);
        $this->assertEquals($expected, $actual);
    }
}