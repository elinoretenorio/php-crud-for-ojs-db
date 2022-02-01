<?php

declare(strict_types=1);

namespace OJS\CustomIssueOrders;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class CustomIssueOrdersController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private ICustomIssueOrdersService $service;

    public function __construct(ICustomIssueOrdersService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var CustomIssueOrdersModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $customIssueOrderId = (int) ($args["custom_issue_order_id"] ?? 0);
        if ($customIssueOrderId <= 0) {
            return new JsonResponse(["result" => $customIssueOrderId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var CustomIssueOrdersModel $model */
        $model = $this->service->createModel($data);
        $model->setCustomIssueOrderId($customIssueOrderId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $customIssueOrderId = (int) ($args["custom_issue_order_id"] ?? 0);
        if ($customIssueOrderId <= 0) {
            return new JsonResponse(["result" => $customIssueOrderId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var CustomIssueOrdersModel $model */
        $model = $this->service->get($customIssueOrderId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var CustomIssueOrdersModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $customIssueOrderId = (int) ($args["custom_issue_order_id"] ?? 0);
        if ($customIssueOrderId <= 0) {
            return new JsonResponse(["result" => $customIssueOrderId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($customIssueOrderId);

        return new JsonResponse(["result" => $result]);
    }
}