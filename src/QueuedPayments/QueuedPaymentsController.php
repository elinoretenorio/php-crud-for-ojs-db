<?php

declare(strict_types=1);

namespace OJS\QueuedPayments;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class QueuedPaymentsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IQueuedPaymentsService $service;

    public function __construct(IQueuedPaymentsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var QueuedPaymentsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $queuedPaymentId = (int) ($args["queued_payment_id"] ?? 0);
        if ($queuedPaymentId <= 0) {
            return new JsonResponse(["result" => $queuedPaymentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var QueuedPaymentsModel $model */
        $model = $this->service->createModel($data);
        $model->setQueuedPaymentId($queuedPaymentId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $queuedPaymentId = (int) ($args["queued_payment_id"] ?? 0);
        if ($queuedPaymentId <= 0) {
            return new JsonResponse(["result" => $queuedPaymentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var QueuedPaymentsModel $model */
        $model = $this->service->get($queuedPaymentId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var QueuedPaymentsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $queuedPaymentId = (int) ($args["queued_payment_id"] ?? 0);
        if ($queuedPaymentId <= 0) {
            return new JsonResponse(["result" => $queuedPaymentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($queuedPaymentId);

        return new JsonResponse(["result" => $result]);
    }
}