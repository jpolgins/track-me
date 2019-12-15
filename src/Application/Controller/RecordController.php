<?php

declare(strict_types=1);

namespace TrackMe\Application\Controller;

use TrackMe\Domain\Model\Record\Record;
use TrackMe\Domain\Model\Record\RecordRepository;
use TrackMe\Infrastructure\Http\Response;

final class RecordController
{
    public const API_PATH = '/api/v13/records';

    private $records;

    public function __construct(RecordRepository $records)
    {
        $this->records = $records;
    }

    public function createAction(string $timeSpent, string $description): Response
    {
        $record = new Record($timeSpent, $description);
        $this->records->add($record);

        return Response::success($record->toArray());
    }

    public function getAction(): Response
    {
        return Response::success($this->records->all());
    }
}
