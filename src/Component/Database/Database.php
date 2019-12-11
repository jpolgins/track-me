<?php

declare(strict_types=1);

namespace TrackMe\Component\Database;

use PDO;
use PDOStatement;

final class Database implements DatabaseInterface
{
    private PDO $pdo;

    private static $connection;

    protected function __construct()
    {
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        $dsn = sprintf('pgsql:host=%s;dbname=%s', 'database', 'dev');
        $this->pdo = new PDO($dsn, 'postgres', '', $opt);
    }

    public static function instance(): self
    {
        if (null === self::$connection) {
            self::$connection = new self();
        }

        return self::$connection;
    }

    public function execute(string $statement): int
    {
        return $this->pdo->exec($this->pdo->prepare($statement)->queryString);
    }

    public function prepare(string $statement): PDOStatement
    {
        return $this->pdo->prepare($statement);
    }

    public function query(string $statement): PDOStatement
    {
        return $this->pdo->query($statement);
    }
}
