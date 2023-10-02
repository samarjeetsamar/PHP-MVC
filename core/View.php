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

        
        extract($data);
       
       // ob_start();
        include $view;
        //return ob_get_clean();
    }

    // public function with($key, $value = null)
    // {
    //     if (is_array($key)) {
    //         $this->data = array_merge($this->data, $key);
    //     } else {
    //         $this->data[$key] = $value;
    //     }
    //     return $this;
    // }

    // public function getPath()
    // {
    //     return $this->viewPath;
    // }

    // public function getData()
    // {
    //     return $this->data;
    // }
}