<?php

declare(strict_types=1);

namespace OJS\Tests\Publications;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Database\DatabaseException;
use OJS\Publications\{ PublicationsDto, IPublicationsRepository, PublicationsRepository };

class PublicationsRepositoryTest extends TestCase
{
    private MockObject $db;
    private MockObject $result;
    private array $input;
    private PublicationsDto $dto;
    private IPublicationsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("OJS\Database\IDatabase");
        $this->result = $this->createMock("OJS\Database\IDatabaseResult");
        $this->input = [
            "publication_id" => 742,
            "access_status" => 834,
            "date_published" => "2022-03-02",
            "last_modified" => "2022-02-07",
            "primary_contact_id" => 2989,
            "section_id" => 2668,
            "seq" => 751.54,
            "submission_id" => 5701,
            "status" => 4931,
            "url_path" => "Form board national real beyond. Pass city price worry. Throw central watch attorney itself dog.",
            "version" => 7402,
        ];
        $this->dto = new PublicationsDto($this->input);
        $this->repository = new PublicationsRepository($this->db);
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
        $expected = 4985;

        $sql = "INSERT INTO `publications` (`access_status`, `date_published`, `last_modified`, `primary_contact_id`, `section_id`, `seq`, `submission_id`, `status`, `url_path`, `version`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->accessStatus,
                $this->dto->datePublished,
                $this->dto->lastModified,
                $this->dto->primaryContactId,
                $this->dto->sectionId,
                $this->dto->seq,
                $this->dto->submissionId,
                $this->dto->status,
                $this->dto->urlPath,
                $this->dto->version
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
        $expected = 7171;

        $sql = "UPDATE `publications` SET `access_status` = ?, `date_published` = ?, `last_modified` = ?, `primary_contact_id` = ?, `section_id` = ?, `seq` = ?, `submission_id` = ?, `status` = ?, `url_path` = ?, `version` = ?
                WHERE `publication_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->accessStatus,
                $this->dto->datePublished,
                $this->dto->lastModified,
                $this->dto->primaryContactId,
                $this->dto->sectionId,
                $this->dto->seq,
                $this->dto->submissionId,
                $this->dto->status,
                $this->dto->urlPath,
                $this->dto->version,
                $this->dto->publicationId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $publicationId = 8016;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($publicationId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $publicationId = 2321;

        $sql = "SELECT `publication_id`, `access_status`, `date_published`, `last_modified`, `primary_contact_id`, `section_id`, `seq`, `submission_id`, `status`, `url_path`, `version`
                FROM `publications` WHERE `publication_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$publicationId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($publicationId);
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
        $sql = "SELECT `publication_id`, `access_status`, `date_published`, `last_modified`, `primary_contact_id`, `section_id`, `seq`, `submission_id`, `status`, `url_path`, `version`
                FROM `publications`";

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
        $publicationId = 9846;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($publicationId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $publicationId = 110;
        $expected = 7046;

        $sql = "DELETE FROM `publications` WHERE `publication_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$publicationId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($publicationId);
        $this->assertEquals($expected, $actual);
    }
}