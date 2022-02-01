<?php

declare(strict_types=1);

namespace OJS\IssueGalleys;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class IssueGalleysController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IIssueGalleysService $service;

    public function __construct(IIssueGalleysService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var IssueGalleysModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $galleyId = (int) ($args["galley_id"] ?? 0);
        if ($galleyId <= 0) {
            return new JsonResponse(["result" => $galleyId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var IssueGalleysModel $model */
        $model = $this->service->createModel($data);
        $model->setGalleyId($galleyId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $galleyId = (int) ($args["galley_id"] ?? 0);
        if ($galleyId <= 0) {
            return new JsonResponse(["result" => $galleyId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var IssueGalleysModel $model */
        $model = $this->service->get($galleyId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var IssueGalleysModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $galleyId = (int) ($args["galley_id"] ?? 0);
        if ($galleyId <= 0) {
            return new JsonResponse(["result" => $galleyId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($galleyId);

        return new JsonResponse(["result" => $result]);
    }
}