<?php

declare(strict_types=1);

namespace OJS\CustomSectionOrders;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class CustomSectionOrdersController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private ICustomSectionOrdersService $service;

    public function __construct(ICustomSectionOrdersService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var CustomSectionOrdersModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $customSectionOrderId = (int) ($args["custom_section_order_id"] ?? 0);
        if ($customSectionOrderId <= 0) {
            return new JsonResponse(["result" => $customSectionOrderId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var CustomSectionOrdersModel $model */
        $model = $this->service->createModel($data);
        $model->setCustomSectionOrderId($customSectionOrderId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $customSectionOrderId = (int) ($args["custom_section_order_id"] ?? 0);
        if ($customSectionOrderId <= 0) {
            return new JsonResponse(["result" => $customSectionOrderId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var CustomSectionOrdersModel $model */
        $model = $this->service->get($customSectionOrderId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var CustomSectionOrdersModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $customSectionOrderId = (int) ($args["custom_section_order_id"] ?? 0);
        if ($customSectionOrderId <= 0) {
            return new JsonResponse(["result" => $customSectionOrderId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($customSectionOrderId);

        return new JsonResponse(["result" => $result]);
    }
}