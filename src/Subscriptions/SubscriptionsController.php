<?php

declare(strict_types=1);

namespace OJS\Subscriptions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class SubscriptionsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private ISubscriptionsService $service;

    public function __construct(ISubscriptionsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var SubscriptionsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $subscriptionId = (int) ($args["subscription_id"] ?? 0);
        if ($subscriptionId <= 0) {
            return new JsonResponse(["result" => $subscriptionId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var SubscriptionsModel $model */
        $model = $this->service->createModel($data);
        $model->setSubscriptionId($subscriptionId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $subscriptionId = (int) ($args["subscription_id"] ?? 0);
        if ($subscriptionId <= 0) {
            return new JsonResponse(["result" => $subscriptionId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var SubscriptionsModel $model */
        $model = $this->service->get($subscriptionId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var SubscriptionsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $subscriptionId = (int) ($args["subscription_id"] ?? 0);
        if ($subscriptionId <= 0) {
            return new JsonResponse(["result" => $subscriptionId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($subscriptionId);

        return new JsonResponse(["result" => $result]);
    }
}