<?php
namespace App\Middleware;

use Core\Redirect;

class Guest {

    public function handle() {
        session_start();
        if($_SESSION['user_id'] ?? false){

            
            Redirect::to(route('dashboard'));
           /// header("location: ". route('dashboard'));
          ///  exit();
        }
    }

}