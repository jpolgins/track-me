<?php

namespace TrackMe\Component\Database;


interface DatabaseInterface
{
    /**
     * @param string $statement
     *
     * @return int
     */
    public function execute(string $statement): int;

    /**
     * @param string $statement
     *
     * @return \PDOStatement
     */
    public function prepare(string $statement): \PDOStatement;

    /**
     * @param string $query
     *
     * @return \PDOStatement
     */
    public function query(string $query): \PDOStatement;
}