<?php

namespace TrackMe\Controller;


use TrackMe\Component\Http\Response;
use TrackMe\Model\Record;
use TrackMe\Repository\RecordRepositoryInterface;

final class RecordController
{
    public const API_PATH = '/api/v13/records';

    /**
     * @var RecordRepositoryInterface
     */
    private $recordRepository;

    /**
     * RecordController constructor.
     *
     * @param RecordRepositoryInterface $recordRepository
     */
    public function __construct(RecordRepositoryInterface $recordRepository)
    {
        $this->recordRepository = $recordRepository;
    }

    /**
     * @param string $timeSpent
     * @param string $description
     *
     * @return Response
     */
    public function createAction(string $timeSpent, string $description): Response
    {
        $record = $this->recordRepository->persist(new Record($timeSpent, $description));

        return Response::ok([
            'timeSpent'     => $record->getTimeSpent(),
            'description'   => $record->getDescription(),
            'createdAt'     => $record->getCreatedAt(),
        ]);
    }

    /**
     * @return Response
     */
    public function getAction(): Response
    {
        $records = $this->recordRepository->findAll();

        return Response::ok($this->groupByRecordCreationDate($records));
    }

    /**
     * @param array $records
     *
     * @return array
     */
    private function groupByRecordCreationDate(array $records): array
    {
        $group = [];

        foreach ($records as $record) {
            $date = \DateTime::createFromFormat(Record::CREATED_AT_FORMAT, $record['createdAt'])->format('Y-m-d');
            $record['title'] = $date;
            $group[$date][] = $record;
        }

        return $group;
    }
}