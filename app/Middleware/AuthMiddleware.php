<?php
namespace App\Middleware;

use Core\Redirect;
use Core\Facade\Auth;
class AuthMiddleware {

    public function handle() {
        session_start();
        if(!Auth::check()){

            Redirect::to(route('showLoginForm'));
           // header("location: ". route('showLoginForm'));
           // exit();
        }
        
    }

}