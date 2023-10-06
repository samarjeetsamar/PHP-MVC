<?php

namespace Core;

class View
{

    protected $data = [];
    protected $view = 'views/index.php';

    public function __construct($view , $data = []) {
        $this->view = $view;
        $this->data = $data;
    }

    public static function render($view, $data = [])
    {

        if(isset($data) && is_array($data)){
            extract($data);
        }
        ob_get_clean();
        require_once $view;
        
    }
}