<?php

declare(strict_types=1);

namespace OJS\Tests\PublicationGalleySettings;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Database\DatabaseException;
use OJS\PublicationGalleySettings\{ PublicationGalleySettingsDto, IPublicationGalleySettingsRepository, PublicationGalleySettingsRepository };

class PublicationGalleySettingsRepositoryTest extends TestCase
{
    private MockObject $db;
    private MockObject $result;
    private array $input;
    private PublicationGalleySettingsDto $dto;
    private IPublicationGalleySettingsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("OJS\Database\IDatabase");
        $this->result = $this->createMock("OJS\Database\IDatabaseResult");
        $this->input = [
            "publication_galley_setting_id" => 9096,
            "galley_id" => 60,
            "locale" => "For quality mission Mr. Direction science final free wall feeling despite. Including cup game ball.",
            "setting_name" => "Trial able sister meeting crime. Decade various program.",
            "setting_value" => "Trial affect voice staff western glass clearly still. Wonder strategy company all certainly must.",
        ];
        $this->dto = new PublicationGalleySettingsDto($this->input);
        $this->repository = new PublicationGalleySettingsRepository($this->db);
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
        $expected = 6812;

        $sql = "INSERT INTO `publication_galley_settings` (`galley_id`, `locale`, `setting_name`, `setting_value`)
                VALUES (?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->galleyId,
                $this->dto->locale,
                $this->dto->settingName,
                $this->dto->settingValue
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
        $expected = 6446;

        $sql = "UPDATE `publication_galley_settings` SET `galley_id` = ?, `locale` = ?, `setting_name` = ?, `setting_value` = ?
                WHERE `publication_galley_setting_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->galleyId,
                $this->dto->locale,
                $this->dto->settingName,
                $this->dto->settingValue,
                $this->dto->publicationGalleySettingId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $publicationGalleySettingId = 5052;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($publicationGalleySettingId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $publicationGalleySettingId = 2907;

        $sql = "SELECT `publication_galley_setting_id`, `galley_id`, `locale`, `setting_name`, `setting_value`
                FROM `publication_galley_settings` WHERE `publication_galley_setting_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$publicationGalleySettingId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($publicationGalleySettingId);
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
        $sql = "SELECT `publication_galley_setting_id`, `galley_id`, `locale`, `setting_name`, `setting_value`
                FROM `publication_galley_settings`";

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
        $publicationGalleySettingId = 2612;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($publicationGalleySettingId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $publicationGalleySettingId = 2175;
        $expected = 3529;

        $sql = "DELETE FROM `publication_galley_settings` WHERE `publication_galley_setting_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$publicationGalleySettingId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($publicationGalleySettingId);
        $this->assertEquals($expected, $actual);
    }
}