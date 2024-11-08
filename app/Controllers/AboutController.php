<?php

namespace App\Controllers;

use Core\View;
use App\Models\User;
use Core\Request;


class AboutController {
    public function index(Request $user){

        
        print_r($user->headers());
        
        
    }
}