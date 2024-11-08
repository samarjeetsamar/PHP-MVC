<?php

namespace App\Controllers;

use Core\View;

class TestingController {

    public function index($id) {
        echo $id;
        $data = 'hi i am samarjeet kumar!!!';
        $data2 = 'hi i am samarjeet kumar saroj!!!';

        View::render('test/index.php', ['data' => $data, 'data2' => $data2, 'id' => $id]);
    }
}