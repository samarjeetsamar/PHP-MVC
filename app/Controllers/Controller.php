<?php

namespace App\Controllers;

use Core\Request;

class Controller {

    protected $request ;

    public function __construct(){
        $this->request = new Request;
    }
}