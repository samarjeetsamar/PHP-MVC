<?php
namespace App\Controllers\Auth;

use Core\Request;
use App\Models\User;
use Core\Redirect;
use Core\Session;
use Core\Validator;
use Core\View;

class RegisterController {

    public function register(){
         View::render('auth/register.php');
    }
    
    public function create(Request $request){

        $data = $request->all();

        $errors = Validator::validate($data, [
            'username' => 'required|min:5',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if(count($errors) > 0){
            Redirect::back()->withErrors($errors);
        }
        
        $user = new User;
        $checkEmail = $user->where('email', '=', $data['email'])->first();
        if($checkEmail) {
            Session::flash('error', 'Email already exist!');
            Redirect::back();
        }

        $rememberToken = null;

        if(isset($data['remember_token'])) {
            $rememberToken = $data['remember_token']; 
            bin2hex(random_bytes(32));
        }
       
        try{
            $user->create([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_BCRYPT),
                'remember_token' => $rememberToken
            ]);

            Session::flash('success', 'Your account has been created successfully! You can login to your account');
        }catch(\Exception $e){
            Session::flash('error', 'Error while inserting data!'. $e->getMessage());
        }
        
        Redirect::back();

    }
}