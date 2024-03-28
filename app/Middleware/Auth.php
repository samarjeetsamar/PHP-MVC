<?php
namespace App\Middleware;

class Auth {

    public function handle() {
        session_start();
        if(!isset($_SESSION['user_id'])){
            header("location: ". route('showLoginForm'));
            exit();
        }
        
    }

}