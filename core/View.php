<?php

namespace Core;

class View
{

    protected $data = [];
    protected $view = '/index.php';

    public function __construct($view , array $data = []) {
        $this->view = $view;
        $this->data = $data;
    }

    public static function render($view, array $data = [])
    {

        if(isset($data) && is_array($data)){
            extract($data);
        }

        //ob_get_clean();
        require_once VIEW_BASE_PATH . $view;
        exit;
        
    }
}