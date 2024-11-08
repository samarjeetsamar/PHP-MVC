<?php
namespace Core;

use Core\DBConnection;
use Exception;
use PDO;


class Model extends DBConnection {

    protected $connection;

    protected $table ;
    protected $primaryKey = 'id';
    protected $columns = '*';
    protected $conditions = [];
    protected $values = [];

    protected $joinQuery = '';

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
        
        $sql .= $this->joinQuery;

        if(!empty($this->conditions)){
            $whereClause = implode(' AND ', $this->conditions);
            $sql .= " WHERE {$whereClause} ";
        }
       
        $stmt = $this->connection->prepare($sql);
        for($i = 0; $i < count($this->values); $i++){
            $stmt->bindValue($i+1, $this->values[$i]);
        }

        
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function first() {
        $sql = "SELECT {$this->columns} FROM {$this->table}";

        $sql .= $this->joinQuery;

        if(!empty($this->conditions)){
            $whereClause = implode(' AND ', $this->conditions);
            $sql .= " WHERE {$whereClause}";
        }

        $stmt = $this->connection->prepare($sql);
        $this->values = array_flatten($this->values);
        
        for($i = 0; $i < count($this->values); $i++){
            $stmt->bindValue($i+1, $this->values[$i]);
        }
        
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
        
        
        
        
        return $stmt->execute();
    }


    public function where($column, $operator, $value){
        $this->conditions[] = "$column $operator ?"; 
        $this->values[] = $value;
        return $this;
    }

    public function sql() {
        return $this->joinQuery;
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

        $this->joinQuery = $sql;
        
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

    public function getTableNameFromClass($relatedModel) {

        
        $reflection = new \ReflectionClass($relatedModel);


        $property = $reflection->getProperty('table');
        $property->setAccessible(true);
        return $property->getValue(new $relatedModel);
    }

    public function belongsTo($relatedModel, $foreignKey){

        try{
            $relatedTable = $this->getTableNameFromClass($relatedModel);
        }catch(\Exception $e){
            echo $e->getMessage();
            exit;
        }

        $this->joinQuery .= " INNER JOIN $relatedTable ON {$this->table}.$foreignKey = $relatedTable.{$this->primaryKey}";

        return $this;
    }

    public function hasMany($relatedModel, $foreignKey){

        
        try{
            $relatedTable = $this->getTableNameFromClass($relatedModel);
        }catch(\Exception $e){
            echo $e->getMessage();
            exit;
        }
       

        $this->joinQuery .= " LEFT JOIN $relatedTable ON {$this->table}.$foreignKey = $relatedTable.{$this->primaryKey}";

        return $this;
    }


    public function with($relationship){

        $relatedModel = "App\\Models\\" . ucfirst($relationship);

        // Check if the related model exists
        if (!class_exists($relatedModel)) {
            throw new \Exception("Related model {$relatedModel} does not exist.");
        }

        if(method_exists(get_called_class(), $relationship)) {
            $this->$relationship();
        }else {
            throw new \Exception('Method ' . $relationship .'() Not Exists');
        }

        return $this;
    }



}