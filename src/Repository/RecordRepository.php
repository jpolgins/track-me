<?php

declare(strict_types=1);

namespace TrackMe\Repository;

use DateTimeImmutable;
use PDO;
use TrackMe\Component\Database\DatabaseInterface;
use TrackMe\Model\Record;

final class RecordRepository implements RecordRepositoryInterface
{
    private DatabaseInterface $database;

    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }

    public function all(): array
    {
        $sql = 'SELECT * FROM records ORDER BY createdAt DESC';

        $result = $this->database->query($sql)->fetchAll();
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

        $statement = $this->database->prepare($sql);
        $statement->bindParam(':time_spent', $record->timeSpent(), PDO::PARAM_STR);
        $statement->bindParam(':description', $record->description(), PDO::PARAM_STR);
        $statement->bindParam(':createdat', $record->createdAt()->format('Y-m-d H:i:s'));
        $statement->execute();
    }
}
