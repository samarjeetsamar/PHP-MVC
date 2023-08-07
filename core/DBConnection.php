<?php

namespace Core;
use PDO;

class DBConnection {

    private $host = "localhost";
    private $username = "root";
    private $password = "password";
    private $dbname = "learn_mvc";
    protected $connection ;

    public function __construct(){

        $options = [
            PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
        ];

        try{
            $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
            $this->connection = new \PDO($dsn, $this->username, $this->password, $options);
        }catch(\PDOException $e){
            die("Connection failed :" . $e->getMessage());
        }
    }

    public function getConnection(){
        return $this->connection;
    }
}