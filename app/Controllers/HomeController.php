<?php 
namespace App\Controllers;
use Core\Request;
use Core\View;
use App\Models\User;

class HomeController  {
    public function index(){

        $user = new User();
        $data = $user->getAllUsers();

        

        View::render('views/index.php', ['data' => $data]);

        
        //return View::render('index.php', $data);
        //return 'hi i am from index of HomeController';
    }
    public function submit(Request $request){

        
        echo 'submit method call';
    }
}