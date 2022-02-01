<?php

declare(strict_types=1);

namespace OJS\Journals;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class JournalsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IJournalsService $service;

    public function __construct(IJournalsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var JournalsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $journalId = (int) ($args["journal_id"] ?? 0);
        if ($journalId <= 0) {
            return new JsonResponse(["result" => $journalId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var JournalsModel $model */
        $model = $this->service->createModel($data);
        $model->setJournalId($journalId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $journalId = (int) ($args["journal_id"] ?? 0);
        if ($journalId <= 0) {
            return new JsonResponse(["result" => $journalId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var JournalsModel $model */
        $model = $this->service->get($journalId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var JournalsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $journalId = (int) ($args["journal_id"] ?? 0);
        if ($journalId <= 0) {
            return new JsonResponse(["result" => $journalId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($journalId);

        return new JsonResponse(["result" => $result]);
    }
}