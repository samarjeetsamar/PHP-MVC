<?php
namespace App\Models;

use App\Models\Model;
use Core\Validator;

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

    public function deleteUser($id){
        $resp = $this->where('id', '=', $id)->delete();
        return $resp;
    }

    public function addUser($data){
        try {
            $resp = $this->table($this->table)->insert($data);
            return $resp;
        }catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function updateUser($data, $id) {

        unset($data['url']);
        try {
            $resp = $this->table($this->table)->where('id', '=' ,$id)->update($data, $id);
            return $resp;
        }catch(\Exception $e){
            return $e->getMessage();
        }
       
    }

    public function authenticate($email, $password){

        $user = $this->table($this->table)->where('email', '=', $email)->where('password', '=', $password)->first();

        if($user){
            return $user;
        }else {
            return false;
        }
        
    }
}
