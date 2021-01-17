<?php
    class Database {
        private string $serverName;
        private string $username;
        private string $password;
        private string $databaseName;

        private $connection;
        private $db;

        function __construct() {
            $this->connection = new mysqli($this->serverName, $this->username, $this->password, $this->databaseName);
        }

        function getConnection() {
            return $this->connection;
        }
    };
?>