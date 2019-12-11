<?php

declare(strict_types=1);

namespace TrackMe\Controller;

use TrackMe\Component\Http\Response;
use TrackMe\Model\Record;
use TrackMe\Repository\RecordRepositoryInterface;

final class RecordController
{
    public const API_PATH = '/api/v13/records';

    private RecordRepositoryInterface $recordRepository;

    public function __construct(RecordRepositoryInterface $recordRepository)
    {
        $this->recordRepository = $recordRepository;
    }

    public function createAction(string $timeSpent, string $description): Response
    {
        $record = new Record($timeSpent, $description);
        $this->recordRepository->add($record);

        return Response::success($record->toArray());
    }

    public function getAction(): Response
    {
        $records = $this->recordRepository->all();

        return Response::success($records);
    }
}
