<?php

declare(strict_types=1);

namespace OJS\PublicationGalleySettings;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class PublicationGalleySettingsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IPublicationGalleySettingsService $service;

    public function __construct(IPublicationGalleySettingsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var PublicationGalleySettingsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $publicationGalleySettingId = (int) ($args["publication_galley_setting_id"] ?? 0);
        if ($publicationGalleySettingId <= 0) {
            return new JsonResponse(["result" => $publicationGalleySettingId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var PublicationGalleySettingsModel $model */
        $model = $this->service->createModel($data);
        $model->setPublicationGalleySettingId($publicationGalleySettingId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $publicationGalleySettingId = (int) ($args["publication_galley_setting_id"] ?? 0);
        if ($publicationGalleySettingId <= 0) {
            return new JsonResponse(["result" => $publicationGalleySettingId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var PublicationGalleySettingsModel $model */
        $model = $this->service->get($publicationGalleySettingId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var PublicationGalleySettingsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $publicationGalleySettingId = (int) ($args["publication_galley_setting_id"] ?? 0);
        if ($publicationGalleySettingId <= 0) {
            return new JsonResponse(["result" => $publicationGalleySettingId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($publicationGalleySettingId);

        return new JsonResponse(["result" => $result]);
    }
}