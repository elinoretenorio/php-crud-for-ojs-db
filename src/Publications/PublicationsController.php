<?php

declare(strict_types=1);

namespace OJS\Publications;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class PublicationsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IPublicationsService $service;

    public function __construct(IPublicationsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var PublicationsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $publicationId = (int) ($args["publication_id"] ?? 0);
        if ($publicationId <= 0) {
            return new JsonResponse(["result" => $publicationId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var PublicationsModel $model */
        $model = $this->service->createModel($data);
        $model->setPublicationId($publicationId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $publicationId = (int) ($args["publication_id"] ?? 0);
        if ($publicationId <= 0) {
            return new JsonResponse(["result" => $publicationId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var PublicationsModel $model */
        $model = $this->service->get($publicationId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var PublicationsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $publicationId = (int) ($args["publication_id"] ?? 0);
        if ($publicationId <= 0) {
            return new JsonResponse(["result" => $publicationId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($publicationId);

        return new JsonResponse(["result" => $result]);
    }
}