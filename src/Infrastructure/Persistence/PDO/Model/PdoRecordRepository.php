<?php

declare(strict_types=1);

namespace TrackMe\Infrastructure\Persistence\PDO\Model;

use DateTimeImmutable;
use PDO;
use TrackMe\Domain\Model\Record\Record;
use TrackMe\Domain\Model\Record\RecordRepository;
use TrackMe\Infrastructure\Persistence\PDO\RDBMS;

final class PdoRecordRepository implements RecordRepository
{
    private RDBMS $db;

    public function __construct(RDBMS $database)
    {
        $this->db = $database;
    }

    public function all(): array
    {
        $sql = 'SELECT * FROM records ORDER BY createdAt DESC';

        $result = $this->db->query($sql)->fetchAll();
        $records = [];

        foreach ($result as $item) {
            $date = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $item['createdat'])->format('Y-m-d');
            $record = [
                'timeSpent' => $item['time_spent'],
                'createdAt' => $item['createdat'],
                'description' => $item['description'],
                'title' => $date,
            ];

            $records[$date][] = $record;
        }

        return $records;
    }

    public function add(Record $record): void
    {
        $sql = 'INSERT INTO records (time_spent, description, createdat) VALUES (:time_spent, :description, :createdat)';

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':time_spent', $record->timeSpent(), PDO::PARAM_STR);
        $statement->bindParam(':description', $record->description(), PDO::PARAM_STR);
        $statement->bindParam(':createdat', $record->createdAt()->format('Y-m-d H:i:s'));
        $statement->execute();
    }
}
