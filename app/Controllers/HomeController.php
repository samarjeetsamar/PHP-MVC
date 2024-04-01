<?php 
namespace App\Controllers;
use Core\Validator;
use Core\Request;
use Core\View;
use App\Models\User;
use Core\Redirect;

class HomeController extends Controller {

    public function index(Request $request){

        $data = $request->all();
        $user = new User();
        $data = $user->getAllUsers();
        View::render('index.php', ['data' => $data]);
    }

    public function getValidationForm(){

        View::render('form/index.php');
    }


    public function postValidationForm(Request $request){

        $input = $request->only(['name', 'email']);
        
        $errors = Validator::validate($input, [
            'name' => 'required|min:5',
            'email' => 'required|email'
        ]);

        if (count($errors) > 0) {
            Redirect::back()->withErrors($errors);
        } 
    
    }


    public function dashboard(){

        

        View::render('dashboard.php');

        // if(session_status() !== PHP_SESSION_ACTIVE ){
        //     session_start();
        // }
        // if(isset($_SESSION['user_id'])) {
        //     View::render('views/dashboard.php');
        // }else {
        //     $url = route('showLoginForm');
        //     redirect($url);
        // }
    }
}