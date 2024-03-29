<?php

namespace Core;
use PDO;


class DBConnection {

    // private $host =   $_ENV['DB_HOST'];
    // private $username = "root";
    // private $password = "password";
    // private $dbname = "learn_mvc";
    protected $connection ;

    private static $instance;

    private $host;
    private $username;
    private $password;
    private $dbname;

    public function __construct(){


        $this->host = $_ENV['DB_HOST'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASS'];
        $this->dbname = $_ENV['DB_NAME'];

        $options = [
            PDO::ATTR_EMULATE_PREPARES   => false, 
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try{
            $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
            $this->connection = new \PDO($dsn, $this->username, $this->password, $options);
        }catch(\PDOException $e){
            die("Connection failed :" . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(){
        return $this->connection;
    }

    
}