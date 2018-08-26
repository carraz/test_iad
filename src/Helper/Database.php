<?php

namespace Helper;

class Database
{
    const CONFIG_PATH = __DIR__ . '/../config/dbconfig.php';
    private static $databasePdoInstance;

    private function __construct()
    {
        require_once self::CONFIG_PATH;

        $dsn = "mysql:dbname=$dbName;host=$dbHost";

        self::$databasePdoInstance = new \PDO(
            $dsn,
            $dbUser,
            $dbPassword,
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
        );
    }

    public static function getInstance()
    {
        if (! self::$databasePdoInstance instanceof \PDO) {
            new self();
        }

        return self::$databasePdoInstance;
    }
}
