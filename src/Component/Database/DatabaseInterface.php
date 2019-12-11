<?php

namespace TrackMe\Component\Database;

use PDOStatement;

interface DatabaseInterface
{
    public function execute(string $statement): int;

    public function prepare(string $statement): PDOStatement;

    public function query(string $query): PDOStatement;
}
