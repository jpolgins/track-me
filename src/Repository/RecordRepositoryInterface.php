<?php

namespace TrackMe\Repository;

use TrackMe\Model\Record;

interface RecordRepositoryInterface
{
    public function all(): array;

    public function add(Record $record): void;
}
