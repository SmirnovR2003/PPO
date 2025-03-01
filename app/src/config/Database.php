<?php

namespace App\Config;

use MongoDB\Client;

class Database
{
    private static $instance = null;
    private $client;
    private $db;

    private function __construct()
    {
        $this->client = new Client(Constants::MONGO_URI);
        $this->db = $this->client->selectDatabase(Constants::MONGO_DB_NAME);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getDb()
    {
        return $this->db;
    }
}