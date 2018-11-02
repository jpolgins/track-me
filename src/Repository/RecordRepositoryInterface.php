<?php

namespace TrackMe\Repository;


use TrackMe\Model\Record;

interface RecordRepositoryInterface
{
    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param Record $record
     *
     * @return Record
     */
    public function persist(Record $record): Record;
}