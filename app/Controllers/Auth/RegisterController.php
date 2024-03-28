<?php
namespace App\Controllers\Auth;

use Core\Request;
use App\Models\User;
use Core\Session;
use Core\Validator;

class RegisterController {
    
    public function create(Request $request){

        $data = $request->all();

        $errors = Validator::validate($data, [
            'username' => 'required|min:5',
            'email' => 'required',
            'password' => 'required|min:8'
        ]);

        $rememberToken = null;

        if(isset($data['remember_token'])) {
            $rememberToken = $data['remember_token']; 
        }

        if(count($errors) > 0){
            redirectBackWithErrors($errors);
        }
       
        try{
            $user = new User;
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
        
        $url = route('User');
        redirect($url);

    }
}