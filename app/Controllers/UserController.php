<?php 

namespace App\Controllers;
use App\Models\User;
use Core\View;

class UserController {

    public function allUsers(){
        $user = new User;
        $users =  $user->getAllUsers();

        View::render('views/users/index.php', $users);
    }
}