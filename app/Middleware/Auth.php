<?php
namespace App\Middleware;

use Core\Redirect;

class Auth {

    public function handle() {
        session_start();
        if(!isset($_SESSION['user_id'])){

            Redirect::to(route('showLoginForm'));
           // header("location: ". route('showLoginForm'));
           // exit();
        }
        
    }

}