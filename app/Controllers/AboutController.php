<?php

namespace App\Controllers;

use Core\View;
use App\Models\User;

class AboutController {
    public function index(){
        $user = new User;
        $data = $user->getAllUsers();

        View::render('views/index.php', $data);
    }
}