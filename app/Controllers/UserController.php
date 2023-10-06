<?php 

namespace App\Controllers;
use App\Models\User;
use Core\View;
use Core\Request;
class UserController {

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

    public function store(Request $request){
        $userName = rtrim($request->all()['email'], '@');
        $data = $request->all();
        $data['username'] = $userName;
        unset($data['url']);
        $user = new User;
        $resp = $user->addUser($data);
        if($resp) {
            $_SESSION['flash_message'] = 'Data inserted successfully.';
        }else{
            $_SESSION['flash_message'] = 'Error while inserting data!';
        }
    }

    public function edit($id){

        $user = new User;
        $data = $user->select(['username', 'email'])->where('id', '=', $id)->first();
        if(!$data) {
            die('User Not Found!');
        }
        $user = ['user' => $data];
        View::render('views/users/edit.php', $user);
    }

    public function editWP($id, $uid){
        
    }

    public function showUserByUserName($userName) {
        echo $userName;
        
    }
}