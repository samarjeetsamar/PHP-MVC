<?php 
namespace App\Controllers;

use App\Exceptions\NotFoundException;
use Core\Validator;
use Core\Request;
use Core\View;
use App\Models\User;
use Core\Redirect;
use App\Models\Post;
use Core\Facade\Auth;

class HomeController extends Controller {

    public function index(Request $request){

        $postObj = new Post;
        $posts = $postObj->getAllPosts();

        View::render('index.php', ['data' => $posts]);
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

        $user = new User;
        $data  = $user->select(['id', 'username', 'email'])->where('id', '=', $_SESSION['user']->id)->first();

        if(!$data) {
            throw new NotFoundException('You are not logged in!');
        }
        
        View::render('dashboard.php', ['data' => $data]);

       
    }
}