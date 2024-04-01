<?php
namespace Core;

class Request {
    protected $input = [];
    protected $request = [] ;
    protected $query= [];
    protected $headers = [];
    protected $files = [];
    protected $methods = [];
    protected $url = '';
    protected $method;

    public function __construct(){
        $this->input = $_POST;
        $this->query = $_GET;
        $this->headers = getallheaders();
        $this->files = $_FILES;
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->url = $_SERVER['REQUEST_URI'];
        $this->request = $_REQUEST;
    }

    public function input($key , $default = null){
        return isset($this->input[$key]) ? $this->input[$key] : $default;
    }

    public function all(){
         return array_merge($this->input, $this->query, $this->files, $this->request);
    }

    public function query($key, $default = null){
        return isset($this->query[$key]) ? $this->query[$key] : $default;
    }

    public function has($key){
        return isset($this->input[$key]) || isset($this->query[$key]);
    }

    public function header($key, $default = null){
        return isset($this->headers[$key]) ? $this->headers[$key] : $default;
    }

    public function headers(){
        return $this->headers;
    }

    public function file($key){
        return isset($this->files[$key]) ? $this->files[$key] : null;
    }

    public function requestMethod(){
        return isset($this->method) ? $this->method : null;
    }

    public function isPost() {
        return (isset($this->method) &&  $this->method = "POST") ? true : false; ;
    }    

    public function only(array $input){
       
        $all = $this->all();
        return array_merge(array_fill_keys($input, null),array_intersect_key($all, array_flip($input)));
        
    }
}