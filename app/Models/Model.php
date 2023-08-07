<?php
namespace App\Models;

use Core\DBConnection;
use PDO;
class Model extends DBConnection {

    protected $connection;

    protected $table ;
    protected $columns = '*';
    protected $conditions = [];
    protected $values = [];

    protected $sqlStatement = '';

    public function __construct(){
        $dbconnection = new DBConnection();
        $this->connection = $dbconnection->getConnection();
    }

    public function table($table) {
        $this->table = $table;
        return $this;
    }

    public function select(array $columns) {
        $columns = implode(', ', $columns);
        $this->columns = $columns;
        return $this;
    }

    public function get(){
        $sql = "SELECT {$this->columns} FROM {$this->table}";

        if(!empty($this->conditions)){
            $whereClause = implode(' AND ', $this->conditions);
            $sql .= " WHERE {$whereClause}";
        }
       
        $stmt = $this->connection->prepare($sql);
        for($i = 0; $i < count($this->values); $i++){
            $stmt->bindValue($i+1, $this->values[$i]);
        }
        $this->sqlStatement = $sql;
        $stmt->execute();
        return $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete(){
        $sql = "DELETE FROM {$this->table}";
        if(!empty($this->conditions)){
            $whereClause = implode(' AND ', $this->conditions);
            $sql .= " WHERE {$whereClause}";
        }

        $stmt = $this->connection->prepare($sql);
       
        for($i = 0; $i < count($this->values); $i++){
            $stmt->bindValue($i+1, $this->values[$i]);
        }
        $this->sqlStatement = $sql;
        return $stmt->execute();
    }


    public function where($column, $operator, $value){
        $this->conditions[] = "$column $operator ?"; 
        $this->values[] = $value;
        return $this;
    }

    public function sql() {
        return $this->sqlStatement;
    }


}