<?php

declare(strict_types=1);

namespace OJS\Tests\Sections;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Database\DatabaseException;
use OJS\Sections\{ SectionsDto, ISectionsRepository, SectionsRepository };

class SectionsRepositoryTest extends TestCase
{
    private MockObject $db;
    private MockObject $result;
    private array $input;
    private SectionsDto $dto;
    private ISectionsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("OJS\Database\IDatabase");
        $this->result = $this->createMock("OJS\Database\IDatabaseResult");
        $this->input = [
            "section_id" => 4739,
            "journal_id" => 2563,
            "review_form_id" => 7332,
            "seq" => 632.00,
            "editor_restricted" => 2793,
            "meta_indexed" => 7559,
            "meta_reviewed" => 9757,
            "abstracts_not_required" => 2008,
            "hide_title" => 2291,
            "hide_author" => 871,
            "is_inactive" => 4266,
            "abstract_word_count" => 1081,
        ];
        $this->dto = new SectionsDto($this->input);
        $this->repository = new SectionsRepository($this->db);
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
        $expected = 9142;

        $sql = "INSERT INTO `sections` (`journal_id`, `review_form_id`, `seq`, `editor_restricted`, `meta_indexed`, `meta_reviewed`, `abstracts_not_required`, `hide_title`, `hide_author`, `is_inactive`, `abstract_word_count`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->journalId,
                $this->dto->reviewFormId,
                $this->dto->seq,
                $this->dto->editorRestricted,
                $this->dto->metaIndexed,
                $this->dto->metaReviewed,
                $this->dto->abstractsNotRequired,
                $this->dto->hideTitle,
                $this->dto->hideAuthor,
                $this->dto->isInactive,
                $this->dto->abstractWordCount
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
        $expected = 5589;

        $sql = "UPDATE `sections` SET `journal_id` = ?, `review_form_id` = ?, `seq` = ?, `editor_restricted` = ?, `meta_indexed` = ?, `meta_reviewed` = ?, `abstracts_not_required` = ?, `hide_title` = ?, `hide_author` = ?, `is_inactive` = ?, `abstract_word_count` = ?
                WHERE `section_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->journalId,
                $this->dto->reviewFormId,
                $this->dto->seq,
                $this->dto->editorRestricted,
                $this->dto->metaIndexed,
                $this->dto->metaReviewed,
                $this->dto->abstractsNotRequired,
                $this->dto->hideTitle,
                $this->dto->hideAuthor,
                $this->dto->isInactive,
                $this->dto->abstractWordCount,
                $this->dto->sectionId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $sectionId = 5583;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($sectionId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $sectionId = 8009;

        $sql = "SELECT `section_id`, `journal_id`, `review_form_id`, `seq`, `editor_restricted`, `meta_indexed`, `meta_reviewed`, `abstracts_not_required`, `hide_title`, `hide_author`, `is_inactive`, `abstract_word_count`
                FROM `sections` WHERE `section_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$sectionId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($sectionId);
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
        $sql = "SELECT `section_id`, `journal_id`, `review_form_id`, `seq`, `editor_restricted`, `meta_indexed`, `meta_reviewed`, `abstracts_not_required`, `hide_title`, `hide_author`, `is_inactive`, `abstract_word_count`
                FROM `sections`";

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
        $sectionId = 519;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($sectionId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $sectionId = 7507;
        $expected = 5771;

        $sql = "DELETE FROM `sections` WHERE `section_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$sectionId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($sectionId);
        $this->assertEquals($expected, $actual);
    }
}