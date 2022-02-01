<?php

declare(strict_types=1);

namespace OJS\SectionSettings;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class SectionSettingsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private ISectionSettingsService $service;

    public function __construct(ISectionSettingsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var SectionSettingsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $sectionSettingId = (int) ($args["section_setting_id"] ?? 0);
        if ($sectionSettingId <= 0) {
            return new JsonResponse(["result" => $sectionSettingId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var SectionSettingsModel $model */
        $model = $this->service->createModel($data);
        $model->setSectionSettingId($sectionSettingId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $sectionSettingId = (int) ($args["section_setting_id"] ?? 0);
        if ($sectionSettingId <= 0) {
            return new JsonResponse(["result" => $sectionSettingId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var SectionSettingsModel $model */
        $model = $this->service->get($sectionSettingId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var SectionSettingsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $sectionSettingId = (int) ($args["section_setting_id"] ?? 0);
        if ($sectionSettingId <= 0) {
            return new JsonResponse(["result" => $sectionSettingId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($sectionSettingId);

        return new JsonResponse(["result" => $result]);
    }
}