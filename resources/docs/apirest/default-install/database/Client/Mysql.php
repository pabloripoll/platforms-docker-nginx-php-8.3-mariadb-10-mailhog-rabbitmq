<?php

namespace Database\Client;

use mysqli;
use mysqli_sql_exception;

class MySQL
{
    public mysqli $db;

    public function __construct()
    {
        // Enable exception mode for MySQLi
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $host = env('MYSQL_HOST');
        $port = env('MYSQL_PORT');
        $name = env('MYSQL_NAME');
        $user = env('MYSQL_USER');
        $pass = env('MYSQL_PASS');

        try {
            $this->db = new mysqli($host, $user, $pass, $name, $port);

            // Set charset to utf8mb4 (recommended for full Unicode support)
            $this->db->set_charset('utf8mb4');

        } catch (mysqli_sql_exception $e) {
            throw new mysqli_sql_exception(
                "Database connection failed: " . $e->getMessage(),
                $e->getCode()
            );
        }
    }

    public function __destruct()
    {
        if (isset($this->db)) {
            $this->db->close();
        }
    }
}
