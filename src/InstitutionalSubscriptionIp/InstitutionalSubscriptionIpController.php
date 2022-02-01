<?php

declare(strict_types=1);

namespace OJS\InstitutionalSubscriptionIp;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class InstitutionalSubscriptionIpController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IInstitutionalSubscriptionIpService $service;

    public function __construct(IInstitutionalSubscriptionIpService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var InstitutionalSubscriptionIpModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $institutionalSubscriptionIpId = (int) ($args["institutional_subscription_ip_id"] ?? 0);
        if ($institutionalSubscriptionIpId <= 0) {
            return new JsonResponse(["result" => $institutionalSubscriptionIpId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var InstitutionalSubscriptionIpModel $model */
        $model = $this->service->createModel($data);
        $model->setInstitutionalSubscriptionIpId($institutionalSubscriptionIpId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $institutionalSubscriptionIpId = (int) ($args["institutional_subscription_ip_id"] ?? 0);
        if ($institutionalSubscriptionIpId <= 0) {
            return new JsonResponse(["result" => $institutionalSubscriptionIpId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var InstitutionalSubscriptionIpModel $model */
        $model = $this->service->get($institutionalSubscriptionIpId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var InstitutionalSubscriptionIpModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $institutionalSubscriptionIpId = (int) ($args["institutional_subscription_ip_id"] ?? 0);
        if ($institutionalSubscriptionIpId <= 0) {
            return new JsonResponse(["result" => $institutionalSubscriptionIpId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($institutionalSubscriptionIpId);

        return new JsonResponse(["result" => $result]);
    }
}