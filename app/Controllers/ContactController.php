<?php

namespace App\Controllers;

use Core\View;
use Core\Request;

class ContactController {

    public function index(){

        View::render('views\contact\index.php');
    }

    public function submitForm(Request $request){

        print_r($request->all());
    }
}