<?php

declare(strict_types=1);

namespace TrackMe;

use TrackMe\Component\Database\Database;
use TrackMe\Component\Http\Request;
use TrackMe\Component\Http\Response;
use TrackMe\Controller\RecordController;
use TrackMe\Repository\RecordRepository;

final class App
{
    public function handle(Request $request): Response
    {
        $recordController = new RecordController(new RecordRepository(Database::instance()));

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
