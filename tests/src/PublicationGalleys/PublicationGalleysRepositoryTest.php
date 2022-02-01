<?php

declare(strict_types=1);

namespace OJS\Tests\PublicationGalleys;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use OJS\Database\DatabaseException;
use OJS\PublicationGalleys\{ PublicationGalleysDto, IPublicationGalleysRepository, PublicationGalleysRepository };

class PublicationGalleysRepositoryTest extends TestCase
{
    private MockObject $db;
    private MockObject $result;
    private array $input;
    private PublicationGalleysDto $dto;
    private IPublicationGalleysRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("OJS\Database\IDatabase");
        $this->result = $this->createMock("OJS\Database\IDatabaseResult");
        $this->input = [
            "galley_id" => 1605,
            "locale" => "Imagine other subject trip. Positive rich help high staff maybe plant test. Thing drug today forget protect clearly each. Into else product great.",
            "publication_id" => 2639,
            "label" => "Would employee food each American product.",
            "submission_file_id" => 3455,
            "seq" => 80.13,
            "remote_url" => "Trouble car much sign. Wide security marriage statement. Bed room crime rest fly. Nothing however forward admit several character quite.",
            "is_approved" => 4634,
            "url_path" => "Since appear young mention forget rule. Most thank professional.",
        ];
        $this->dto = new PublicationGalleysDto($this->input);
        $this->repository = new PublicationGalleysRepository($this->db);
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
        $expected = 5918;

        $sql = "INSERT INTO `publication_galleys` (`locale`, `publication_id`, `label`, `submission_file_id`, `seq`, `remote_url`, `is_approved`, `url_path`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->locale,
                $this->dto->publicationId,
                $this->dto->label,
                $this->dto->submissionFileId,
                $this->dto->seq,
                $this->dto->remoteUrl,
                $this->dto->isApproved,
                $this->dto->urlPath
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
        $expected = 6238;

        $sql = "UPDATE `publication_galleys` SET `locale` = ?, `publication_id` = ?, `label` = ?, `submission_file_id` = ?, `seq` = ?, `remote_url` = ?, `is_approved` = ?, `url_path` = ?
                WHERE `galley_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->locale,
                $this->dto->publicationId,
                $this->dto->label,
                $this->dto->submissionFileId,
                $this->dto->seq,
                $this->dto->remoteUrl,
                $this->dto->isApproved,
                $this->dto->urlPath,
                $this->dto->galleyId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $galleyId = 227;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($galleyId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $galleyId = 3199;

        $sql = "SELECT `galley_id`, `locale`, `publication_id`, `label`, `submission_file_id`, `seq`, `remote_url`, `is_approved`, `url_path`
                FROM `publication_galleys` WHERE `galley_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$galleyId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($galleyId);
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
        $sql = "SELECT `galley_id`, `locale`, `publication_id`, `label`, `submission_file_id`, `seq`, `remote_url`, `is_approved`, `url_path`
                FROM `publication_galleys`";

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
        $galleyId = 5633;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($galleyId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $galleyId = 4538;
        $expected = 8708;

        $sql = "DELETE FROM `publication_galleys` WHERE `galley_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$galleyId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($galleyId);
        $this->assertEquals($expected, $actual);
    }
}