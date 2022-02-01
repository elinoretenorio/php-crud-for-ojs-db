<?php

declare(strict_types=1);

namespace OJS\Tests\Issues;

use PHPUnit\Framework\TestCase;
use OJS\Issues\{ IssuesDto, IssuesModel };

class IssuesModelTest extends TestCase
{
    private array $input;
    private IssuesDto $dto;
    private IssuesModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "issue_id" => 1236,
            "journal_id" => 6945,
            "volume" => 568,
            "number" => "Enter low green management need your card. Major happen that art data soon spend. Might miss if owner result.",
            "year" => 6289,
            "published" => 4993,
            "date_published" => "2022-02-16",
            "date_notified" => "2022-02-27",
            "last_modified" => "2022-02-03",
            "access_status" => 2967,
            "open_access_date" => "2022-02-12",
            "show_volume" => 2161,
            "show_number" => 6316,
            "show_year" => 9524,
            "show_title" => 323,
            "style_file_name" => "List standard candidate raise turn could standard difficult. Else short suffer always argue door already generation. Nothing marriage television game marriage.",
            "original_style_file_name" => "Town thus until thought. Life dark together watch fund. Factor stage me fish so organization book.",
            "url_path" => "Me hotel carry wife theory. Anything respond nor modern surface step hot.",
        ];
        $this->dto = new IssuesDto($this->input);
        $this->model = new IssuesModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new IssuesModel(null);

        $this->assertInstanceOf(IssuesModel::class, $model);
    }

    public function testGetIssueId(): void
    {
        $this->assertEquals($this->dto->issueId, $this->model->getIssueId());
    }

    public function testSetIssueId(): void
    {
        $expected = 1149;
        $model = $this->model;
        $model->setIssueId($expected);

        $this->assertEquals($expected, $model->getIssueId());
    }

    public function testGetJournalId(): void
    {
        $this->assertEquals($this->dto->journalId, $this->model->getJournalId());
    }

    public function testSetJournalId(): void
    {
        $expected = 9533;
        $model = $this->model;
        $model->setJournalId($expected);

        $this->assertEquals($expected, $model->getJournalId());
    }

    public function testGetVolume(): void
    {
        $this->assertEquals($this->dto->volume, $this->model->getVolume());
    }

    public function testSetVolume(): void
    {
        $expected = 2542;
        $model = $this->model;
        $model->setVolume($expected);

        $this->assertEquals($expected, $model->getVolume());
    }

    public function testGetNumber(): void
    {
        $this->assertEquals($this->dto->number, $this->model->getNumber());
    }

    public function testSetNumber(): void
    {
        $expected = "One million meet detail movement age could college. Along large fear lot artist.";
        $model = $this->model;
        $model->setNumber($expected);

        $this->assertEquals($expected, $model->getNumber());
    }

    public function testGetYear(): void
    {
        $this->assertEquals($this->dto->year, $this->model->getYear());
    }

    public function testSetYear(): void
    {
        $expected = 9561;
        $model = $this->model;
        $model->setYear($expected);

        $this->assertEquals($expected, $model->getYear());
    }

    public function testGetPublished(): void
    {
        $this->assertEquals($this->dto->published, $this->model->getPublished());
    }

    public function testSetPublished(): void
    {
        $expected = 2357;
        $model = $this->model;
        $model->setPublished($expected);

        $this->assertEquals($expected, $model->getPublished());
    }

    public function testGetDatePublished(): void
    {
        $this->assertEquals($this->dto->datePublished, $this->model->getDatePublished());
    }

    public function testSetDatePublished(): void
    {
        $expected = "2022-02-05";
        $model = $this->model;
        $model->setDatePublished($expected);

        $this->assertEquals($expected, $model->getDatePublished());
    }

    public function testGetDateNotified(): void
    {
        $this->assertEquals($this->dto->dateNotified, $this->model->getDateNotified());
    }

    public function testSetDateNotified(): void
    {
        $expected = "2022-02-05";
        $model = $this->model;
        $model->setDateNotified($expected);

        $this->assertEquals($expected, $model->getDateNotified());
    }

    public function testGetLastModified(): void
    {
        $this->assertEquals($this->dto->lastModified, $this->model->getLastModified());
    }

    public function testSetLastModified(): void
    {
        $expected = "2022-02-11";
        $model = $this->model;
        $model->setLastModified($expected);

        $this->assertEquals($expected, $model->getLastModified());
    }

    public function testGetAccessStatus(): void
    {
        $this->assertEquals($this->dto->accessStatus, $this->model->getAccessStatus());
    }

    public function testSetAccessStatus(): void
    {
        $expected = 7138;
        $model = $this->model;
        $model->setAccessStatus($expected);

        $this->assertEquals($expected, $model->getAccessStatus());
    }

    public function testGetOpenAccessDate(): void
    {
        $this->assertEquals($this->dto->openAccessDate, $this->model->getOpenAccessDate());
    }

    public function testSetOpenAccessDate(): void
    {
        $expected = "2022-02-11";
        $model = $this->model;
        $model->setOpenAccessDate($expected);

        $this->assertEquals($expected, $model->getOpenAccessDate());
    }

    public function testGetShowVolume(): void
    {
        $this->assertEquals($this->dto->showVolume, $this->model->getShowVolume());
    }

    public function testSetShowVolume(): void
    {
        $expected = 6064;
        $model = $this->model;
        $model->setShowVolume($expected);

        $this->assertEquals($expected, $model->getShowVolume());
    }

    public function testGetShowNumber(): void
    {
        $this->assertEquals($this->dto->showNumber, $this->model->getShowNumber());
    }

    public function testSetShowNumber(): void
    {
        $expected = 5405;
        $model = $this->model;
        $model->setShowNumber($expected);

        $this->assertEquals($expected, $model->getShowNumber());
    }

    public function testGetShowYear(): void
    {
        $this->assertEquals($this->dto->showYear, $this->model->getShowYear());
    }

    public function testSetShowYear(): void
    {
        $expected = 1317;
        $model = $this->model;
        $model->setShowYear($expected);

        $this->assertEquals($expected, $model->getShowYear());
    }

    public function testGetShowTitle(): void
    {
        $this->assertEquals($this->dto->showTitle, $this->model->getShowTitle());
    }

    public function testSetShowTitle(): void
    {
        $expected = 3747;
        $model = $this->model;
        $model->setShowTitle($expected);

        $this->assertEquals($expected, $model->getShowTitle());
    }

    public function testGetStyleFileName(): void
    {
        $this->assertEquals($this->dto->styleFileName, $this->model->getStyleFileName());
    }

    public function testSetStyleFileName(): void
    {
        $expected = "Choice than take visit them. Record name blood company speech Congress song. Thank defense should lawyer majority.";
        $model = $this->model;
        $model->setStyleFileName($expected);

        $this->assertEquals($expected, $model->getStyleFileName());
    }

    public function testGetOriginalStyleFileName(): void
    {
        $this->assertEquals($this->dto->originalStyleFileName, $this->model->getOriginalStyleFileName());
    }

    public function testSetOriginalStyleFileName(): void
    {
        $expected = "Recently bag something step billion speak today. Month college measure almost entire a range.";
        $model = $this->model;
        $model->setOriginalStyleFileName($expected);

        $this->assertEquals($expected, $model->getOriginalStyleFileName());
    }

    public function testGetUrlPath(): void
    {
        $this->assertEquals($this->dto->urlPath, $this->model->getUrlPath());
    }

    public function testSetUrlPath(): void
    {
        $expected = "Note program very success. Large expect rise what wall experience. Say with suddenly trial.";
        $model = $this->model;
        $model->setUrlPath($expected);

        $this->assertEquals($expected, $model->getUrlPath());
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