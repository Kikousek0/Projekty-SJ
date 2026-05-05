<?php
class Database {
    protected $connection;

    public function __construct() {
        require_once('db/config.php');

        $this->connection = $conn;
    }
}
?>