<?php

declare(strict_types=1);

namespace OJS\Tests\IssueSettings;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Database\DatabaseException;
use OJS\IssueSettings\{ IssueSettingsDto, IIssueSettingsRepository, IssueSettingsRepository };

class IssueSettingsRepositoryTest extends TestCase
{
    private MockObject $db;
    private MockObject $result;
    private array $input;
    private IssueSettingsDto $dto;
    private IIssueSettingsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("OJS\Database\IDatabase");
        $this->result = $this->createMock("OJS\Database\IDatabaseResult");
        $this->input = [
            "issue_setting_id" => 5168,
            "issue_id" => 3762,
            "locale" => "Stuff nor beyond skin six light. Now human customer watch ground machine increase.",
            "setting_name" => "Discover idea blood customer. Focus history argue agent. Seven heart drug PM form huge.",
            "setting_value" => "Fast author cover task. Laugh hotel away second wear focus piece. Song ability large easy.",
            "setting_type" => "Investment person family star rest increase. Hot all admit baby team. Rather although air leg edge production.",
        ];
        $this->dto = new IssueSettingsDto($this->input);
        $this->repository = new IssueSettingsRepository($this->db);
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
        $expected = 6395;

        $sql = "INSERT INTO `issue_settings` (`issue_id`, `locale`, `setting_name`, `setting_value`, `setting_type`)
                VALUES (?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->issueId,
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
        $expected = 5164;

        $sql = "UPDATE `issue_settings` SET `issue_id` = ?, `locale` = ?, `setting_name` = ?, `setting_value` = ?, `setting_type` = ?
                WHERE `issue_setting_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->issueId,
                $this->dto->locale,
                $this->dto->settingName,
                $this->dto->settingValue,
                $this->dto->settingType,
                $this->dto->issueSettingId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $issueSettingId = 9205;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($issueSettingId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $issueSettingId = 3924;

        $sql = "SELECT `issue_setting_id`, `issue_id`, `locale`, `setting_name`, `setting_value`, `setting_type`
                FROM `issue_settings` WHERE `issue_setting_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$issueSettingId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($issueSettingId);
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
        $sql = "SELECT `issue_setting_id`, `issue_id`, `locale`, `setting_name`, `setting_value`, `setting_type`
                FROM `issue_settings`";

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
        $issueSettingId = 1861;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($issueSettingId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $issueSettingId = 9966;
        $expected = 9100;

        $sql = "DELETE FROM `issue_settings` WHERE `issue_setting_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$issueSettingId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($issueSettingId);
        $this->assertEquals($expected, $actual);
    }
}