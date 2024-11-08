<?php
namespace App\Middleware;

use Core\Redirect;
use Core\Facade\Auth;

class AuthMiddleware {

    public function handle() {
        if(!Auth::check()){
            Redirect::to(route('showLoginForm'));
            return;
        }
    }

}