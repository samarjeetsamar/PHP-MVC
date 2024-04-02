<?php
namespace App\Controllers\Auth;

use App\Controllers\Controller;
use Core\View;
use App\Models\User;
use Core\Redirect;
use Core\Request;
use Core\Facade\Auth;

class Logincontroller extends Controller {
    

    private $isAuthenticated  = false; 

    public function __construct(){
        //$this->isAuthenticated = true;
    }    

    public function showLogin(){
        View::render('auth/login.php');
    }


    public function login(Request $request){

        $data = $request->all();
        $email = $data['email'];
        $password = $data['password'];


        $rememberToken = null;
        if(isset($data['rememberme_token'])) {
            $rememberToken = $data['rememberme_token'];
        }

        $userObj =  new User;
        $user = $userObj->authenticate($email, $password);
        
        if($user){
            session_start();
            $_SESSION['user'] =  $user;
            Redirect::to(route('dashboard'))->with('success', 'You are logged in !');
        }else {
            $error = 'Error while login !';
            Redirect::back()->with('error', $error);
        }

    }

    public function logout() {
        session_start();
        $_SESSION = array();
        session_destroy();

        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }
        
        Redirect::to(route('showLoginForm'));

    }

}