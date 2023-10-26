<?php 
namespace App\Controllers;
use Core\Request;
use Core\View;
use App\Models\User;

use Core\Validator;
use Core\Session;


class HomeController extends Controller {

    public function index(){

        $data = $this->request->all();
        $user = new User();
        $data = $user->getAllUsers();
        View::render('views/index.php', ['data' => $data]);
    }

    public function getValidationForm(){

        View::render('views/form/index.php');
    }


    public function postValidationForm(){

        $data = $this->request->all();
        unset($data['url']);

        $errors = Validator::validate($data, [
            'name' => 'required|min:5',
            'email' => 'required|min:50'
        ]);

        if (count($errors) > 0) {
            redirectBackWithErrors($errors);
        } 
    }


    public function dashboard(){

        if(session_status() !== PHP_SESSION_ACTIVE ){
            session_start();
        }
        if(isset($_SESSION['user_id'])) {
            View::render('views/dashboard.php');
        }else {
            $url = route('showLoginForm');
            redirect($url);
        }
    }
}