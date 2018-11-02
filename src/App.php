<?php

namespace TrackMe;

use TrackMe\Component\Database\Database;
use TrackMe\Component\Http\Request;
use TrackMe\Component\Http\Response;
use TrackMe\Controller\RecordController;
use TrackMe\Repository\RecordRepository;

final class App
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request): Response
    {
        $recordController = new RecordController(new RecordRepository(Database::instance()));

        if (RecordController::API_PATH === $request->getRequestUri()) {

            if ($request->getMethod() === Request::HTTP_POST) {
                return $recordController->createAction(
                    $request->request['timeSpent'],
                    $request->request['description']
                );
            }

            if ($request->getMethod() === Request::HTTP_GET) {
                return $recordController->getAction();
            }

        }

        return Response::notFound('Route not found');
    }
}