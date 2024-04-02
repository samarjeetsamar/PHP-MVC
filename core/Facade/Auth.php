<?php

namespace Core\Facade;

class Auth {

    
    public function __construct()
    {
        session_start();
    }

    public static function check()
    {
        (session_status() == PHP_SESSION_NONE) ? session_start() : null ;

        return isset($_SESSION['user']);
    }

    // Example implementation of user method
    public static function user()
    {
        return $_SESSION['user'] ?? null;
    }
}