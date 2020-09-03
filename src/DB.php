<?php

namespace App;

use Nette\Database\Connection;

class DB
{
    /**
     * @return Connection
     */
    public static function create(): Connection
    {
        $dsn = "{$_ENV['DB_CONNECTION']}:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_DATABASE']}";
        return new Connection("$dsn", $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
    }
}