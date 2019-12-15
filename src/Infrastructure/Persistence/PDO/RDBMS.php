<?php

namespace TrackMe\Infrastructure\Persistence\PDO;

use PDOStatement;

interface RDBMS
{
    public function execute(string $statement): int;

    public function prepare(string $statement): PDOStatement;

    public function query(string $query): PDOStatement;
}
