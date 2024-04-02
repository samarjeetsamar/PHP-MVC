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

    private $data;

    public function __construct(){
        $this->connection = DBConnection::getInstance()->getConnection();
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
            $sql .= " WHERE {$whereClause} ";
        }
       
        $stmt = $this->connection->prepare($sql);
        for($i = 0; $i < count($this->values); $i++){
            $stmt->bindValue($i+1, $this->values[$i]);
        }
        $this->sqlStatement = $sql;
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function first() {
        $sql = "SELECT {$this->columns} FROM {$this->table}";
        if(!empty($this->conditions)){
            $whereClause = implode(' AND ', $this->conditions);
            $sql .= " WHERE {$whereClause}";
        }

        $stmt = $this->connection->prepare($sql);
        $this->values = array_flatten($this->values);
        
        for($i = 0; $i < count($this->values); $i++){
            $stmt->bindValue($i+1, $this->values[$i]);
        }
        $this->sqlStatement = $sql;
        $stmt->execute();
        $fetachData =  $stmt->fetch(PDO::FETCH_OBJ);
        $this->data = $fetachData;
        return $fetachData;

    }

    public function delete(){
       // $sql = '';
        $sql = "DELETE FROM {$this->table}";
        if(!empty($this->conditions)){
            $whereClause = implode(' AND ', $this->conditions);
            $sql .= " WHERE {$whereClause}";
        }

        $stmt = $this->connection->prepare($sql);

        $this->values = array_flatten($this->values);
       
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

    public function insert(array $data){
        $this->columns =  implode(', ', array_keys($data));
        $this->values = implode(', ', array_values($data));

        $placeholders = [];
        foreach ($data as $key => $value) {
            $placeholders[":$key"] = $value;
        }
        $params = implode(', ', array_keys($placeholders));
        $sql = "INSERT INTO {$this->table} ($this->columns) values($params)";
       
        $stmt = $this->connection->prepare($sql);
        
        $stmt->execute($placeholders);
        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
       
    }

    public function update($data, $id){

        $setStatemet = '';
        
        foreach($data as $key => $val) {
            $setStatemet .= "$key=?, ";
        } 
        $setStatemet = rtrim($setStatemet, ', ');
        $data['id'] = $id;
        $this->values = array_flatten(array_values($data)); 
        
        $sql = "UPDATE {$this->table} SET " . $setStatemet;
        
        if(!empty($this->conditions)){
            $whereClause = implode(' AND ', $this->conditions);
            $sql .= " WHERE {$whereClause}";
        }

        $this->sqlStatement = $sql;
        
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($this->values);
            return true;
        } catch (\PDOException $e) {
            return false; // Handle the error as needed
        }

    }

    public function toArray(){
        $array = [];
        foreach ($this->data as $key => $value) {
            if (is_object($value) && method_exists($value, 'toArray')) {
                $array[$key] = $value->toArray();
            } else {
                $array[$key] = $value;
            }
        }
        return $array;
    }

}