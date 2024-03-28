<?php
namespace App\Middleware;

class Guest {

    public function handle() {
        session_start();
        if($_SESSION['user_id'] ?? false){
            header("location: /");
            exit();
        }
    }

}