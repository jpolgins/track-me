<?php

namespace TrackMe\Repository;

use TrackMe\Component\Database\DatabaseInterface;
use TrackMe\Model\Record;

class RecordRepository implements RecordRepositoryInterface
{
    /**
     * @var DatabaseInterface
     */
    private $database;

    /**
     * RecordRepository constructor.
     *
     * @param DatabaseInterface $database
     */
    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        $sql = 'SELECT * FROM records ORDER BY createdAt DESC';

        $statement = $this->database->query($sql);

        return $statement->fetchAll();
    }

    /**
     * @param Record $record
     *
     * @return Record
     */
    public function persist(Record $record): Record
    {
        $sql = 'INSERT INTO records (timeSpent, description, createdAt) VALUES (:timeSpent, :description, :createdAt)';

        $statement = $this->database->prepare($sql);
        $statement->bindParam(':timeSpent', $record->getTimeSpent(), \PDO::PARAM_STR);
        $statement->bindParam(':description', $record->getDescription(), \PDO::PARAM_STR);
        $statement->bindParam(':createdAt', $record->getCreatedAt());
        $statement->execute();

        return $record;
    }
}