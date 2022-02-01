<?php

declare(strict_types=1);

namespace OJS\SubscriptionTypes;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class SubscriptionTypesController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private ISubscriptionTypesService $service;

    public function __construct(ISubscriptionTypesService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var SubscriptionTypesModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $typeId = (int) ($args["type_id"] ?? 0);
        if ($typeId <= 0) {
            return new JsonResponse(["result" => $typeId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var SubscriptionTypesModel $model */
        $model = $this->service->createModel($data);
        $model->setTypeId($typeId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $typeId = (int) ($args["type_id"] ?? 0);
        if ($typeId <= 0) {
            return new JsonResponse(["result" => $typeId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var SubscriptionTypesModel $model */
        $model = $this->service->get($typeId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var SubscriptionTypesModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $typeId = (int) ($args["type_id"] ?? 0);
        if ($typeId <= 0) {
            return new JsonResponse(["result" => $typeId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($typeId);

        return new JsonResponse(["result" => $result]);
    }
}