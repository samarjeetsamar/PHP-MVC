<?php
namespace App\Models;

use App\Models\Model;
//use PDO;

class User extends Model {
    protected $table = "users";
    
    public function getAllUsers() {
        $allUsers = $this->select(['*'])->get();
        return $allUsers;
    }

    public function getUserById($id){
        $user = $this->select(['*'])->where('id', '=', $id)->first();
        return $user;
    }

    public function deleteUser(){
        $resp = $this->delete();
        return $resp;
    }

    public function addUser($data){
        $resp = $this->table($this->table)->insert($data);
        return $resp;
    }

    
}
