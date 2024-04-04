<?php 

namespace App\Controllers;
use App\Models\User;
use Core\View;
use Core\Session;
use Core\Validator;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;
use Core\Request;
use Core\Redirect;
use Exception;

class UserController extends Controller {



    public function index(){
        View::render('users/create.php');
    }

    public function show($id) 
    {
        $user = new User;
        $data = $user->getUserById($id);
        if(!$data) {
            die('User Not Found!');
        }
         
        View::render('users/show.php', $data);
    }

    public function allUsers(){
        $user = new User;
        $users =  $user->getAllUsers();
        View::render('/users/index.php', $users);
    }

    public function edit($id){

        $user = new User;

        try {
            $data = $user->select(['id', 'username', 'email'])->where('id', '=', $id)->first();
            if(!$data) {
                throw new NotFoundException('User Not found!');
            }
        }catch(NotFoundException $e){
            echo $e->getMessage();
            exit;
        }  
        
        $user = ['user' => $data];
        
        View::render('users/edit.php', $user);
    }

    public function editWP(Request $request, $id, $uid){
        
        
       
        //print_r($request);

    }

    public function showUserByUserName($userName) {
        
        
    }

    public function delete($id){    
        $user = new User;
        try {
            $user = $user->deleteUser($id);
            if($user) {
                $msg = 'User Deleted successfully!';
                Redirect::back()->with('success', $msg);
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }

        return Redirect::back();
        //return redirectBack();

    }

    public function update(Request $request, $id){

        $data = $request->all();
        $errors = Validator::validate($data, [
            'username' => 'required|min:5',
            'email' => 'required|email',
        ]);

        if(count($errors) > 0){
            Redirect::back()->withErrors($errors);
        }

        $user  = new User;
        $updated = $user->updateUser($data, $id);

        if($updated){
            Redirect::back()->with('success', 'User Recored Updated Successfully!');
        }else {
            Redirect::back()->with('error', 'Something went wrong!');
        }
    }

    public function profile($username){
        
        $userObj = new User;
        $user = $userObj->select(['*'])->where('username', '=', 'samarjeet kumar')->first();
        
        if($user) {
            View::render('users/show.php', ['data' => $user]);
        }
        
        throw new NotFoundException('User not found!');
    }
}