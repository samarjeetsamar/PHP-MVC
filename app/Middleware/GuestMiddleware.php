<?php
namespace App\Middleware;

use Core\Redirect;
use Core\Facade\Auth;

class GuestMiddleware {

    public function handle() {
        session_start();
        if(Auth::user() ?? false){
            Redirect::to(route('dashboard'));
        }
    }

}