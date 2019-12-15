<?php

declare(strict_types=1);

namespace TrackMe;

use TrackMe\Application\Controller\RecordController;
use TrackMe\Infrastructure\Http\Request;
use TrackMe\Infrastructure\Http\Response;
use TrackMe\Infrastructure\Persistence\PDO\Model\PdoRecordRepository;
use TrackMe\Infrastructure\Persistence\PDO\Postgres;

final class App
{
    public function handle(Request $request): Response
    {
        $recordController = new RecordController(new PdoRecordRepository(Postgres::instance()));

        if (RecordController::API_PATH === $request->getRequestUri()) {

            if (Request::HTTP_POST === $request->getMethod()) {
                return $recordController->createAction(
                    $request->request['timeSpent'],
                    $request->request['description']
                );
            }

            if (Request::HTTP_GET === $request->getMethod()) {
                return $recordController->getAction();
            }
        }

        return Response::notFound('Route not found');
    }
}
