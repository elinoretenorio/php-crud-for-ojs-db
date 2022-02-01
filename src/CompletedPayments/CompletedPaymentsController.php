<?php

declare(strict_types=1);

namespace OJS\CompletedPayments;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class CompletedPaymentsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private ICompletedPaymentsService $service;

    public function __construct(ICompletedPaymentsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var CompletedPaymentsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $completedPaymentId = (int) ($args["completed_payment_id"] ?? 0);
        if ($completedPaymentId <= 0) {
            return new JsonResponse(["result" => $completedPaymentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var CompletedPaymentsModel $model */
        $model = $this->service->createModel($data);
        $model->setCompletedPaymentId($completedPaymentId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $completedPaymentId = (int) ($args["completed_payment_id"] ?? 0);
        if ($completedPaymentId <= 0) {
            return new JsonResponse(["result" => $completedPaymentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var CompletedPaymentsModel $model */
        $model = $this->service->get($completedPaymentId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var CompletedPaymentsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $completedPaymentId = (int) ($args["completed_payment_id"] ?? 0);
        if ($completedPaymentId <= 0) {
            return new JsonResponse(["result" => $completedPaymentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($completedPaymentId);

        return new JsonResponse(["result" => $result]);
    }
}