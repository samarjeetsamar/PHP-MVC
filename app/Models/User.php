<?php
namespace App\Models;

use App\Models\Model;
//use PDO;

class User extends Model {
    protected $table = "users";
    
    public function getAllUsers() {
        $allUsers = $this->select(['*'])->where('id', '=', 1)->get();
        return $allUsers;
    }

    public function deleteUser(){
        $resp = $this->delete();
        return $resp;
    }

    
}
