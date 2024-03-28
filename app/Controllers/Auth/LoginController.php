<?php
namespace App\Controllers\Auth;

use App\Controllers\Controller;
use Core\View;
use App\Models\User;
use Core\Request;

class Logincontroller extends Controller {
    

    private $isAuthenticated  = false; 

    public function __construct(){
        //$this->isAuthenticated = true;
    }    

    public function showLogin(){
        View::render('views\auth\login.php');
    }


    public function login(Request $request){

        $data = $request->all();
        $email = $data['email'];
        $password = $data['password'];


        $rememberToken = null;
        if(isset($data['rememberme_token'])) {
            $rememberToken = $data['rememberme_token'];
        }

        $user =  new User;
        $userResp = $user->authenticate($email, $password);

        if($userResp){

            session_start();
            $_SESSION['user'] =  $userResp;
            $_SESSION['user_id'] =  $userResp->id;
            
            $dashboard = route('dashboard');
            
            redirect($dashboard);
           // redirectToDashboard();
        }else {
            $error = 'Error while login !';
            redirectWithErrorMsg($error);
        }

    }

    public function logout() {
        session_start();
        $_SESSION = array();
        session_destroy();

        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }
        $url = route('showLoginForm');
        
        redirect($url);

    }

}