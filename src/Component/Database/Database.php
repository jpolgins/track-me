<?php

namespace TrackMe\Component\Database;


final class Database implements DatabaseInterface
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @var Database
     */
    private static $instance;

    protected function __construct()
    {
        $opt = [
            \PDO::ATTR_ERRMODE              => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE   => \PDO::FETCH_ASSOC,
        ];

        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8', getenv('MYSQL_HOST'), getenv('MYSQL_DATABASE'));
        $this->pdo = new \PDO($dsn, getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'), $opt);
    }

    /**
     * @return Database
     */
    public static function instance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * @param string $statement
     *
     * @return int
     */
    public function execute(string $statement): int
    {
        return $this->pdo->exec($this->pdo->prepare($statement)->queryString);
    }

    /**
     * @param string $statement
     *
     * @return \PDOStatement
     */
    public function prepare(string $statement): \PDOStatement
    {
        return $this->pdo->prepare($statement);
    }

    /**
     * @param string $statement
     *
     * @return \PDOStatement
     */
    public function query(string $statement): \PDOStatement
    {
        return $this->pdo->query($statement);
    }
}