<?php

namespace TrackMe\Domain\Model\Record;

interface RecordRepository
{
    public function all(): array;

    public function add(Record $record): void;
}
