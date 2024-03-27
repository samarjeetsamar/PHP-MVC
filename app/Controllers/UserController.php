<?php 

namespace App\Controllers;
use App\Models\User;
use Core\View;
use Core\Session;
use Core\Validator;
use App\Controllers\Controller;
use Core\Request;


class UserController extends Controller {



    public function index(){
        View::render('views/users/create.php');
    }

    public function show($id) 
    {
        $user = new User;
        $data = $user->getUserById($id);
        if(!$data) {
            die('User Not Found!');
        }
         
        View::render('views/users/show.php', $data);
    }

    public function allUsers(){
        $user = new User;
        $users =  $user->getAllUsers();
        View::render('views/users/index.php', $users);
    }

    public function edit( $id){


        $user = new User;
        $data = $user->select(['id', 'username', 'email'])->where('id', '=', $id)->first();
        
        if(!$data) {
            die('User Not Found!');
        }
        $user = ['user' => $data];
        
        View::render('views/users/edit.php', $user);
    }

    public function editWP(Request $request, $id, $uid){
        
        print_r($request->all());
        print_r($id);
        print_r($uid) ;

        echo $id;
        echo $uid;
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
                redirectWithSuccessMsg($msg);
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }

        return redirectBack();

    }

    public function update(Request $request, $id){
        $data = $request->all();
        //die;

        $errors = Validator::validate($data, [
            'username' => 'required|min:5',
            'email' => 'required',
        ]);

        if(count($errors) > 0){
            redirectBackWithErrors($errors);
        }

        $user  = new User;
        $updated = $user->updateUser($data, $id);
        
        if($updated){
            redirectWithSuccessMsg('User Recored Updated Successfully!');
        }else {
            redirectBackWithErrors(['error while updating user record!']);
        }
    }
}