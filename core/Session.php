<?php
namespace Core;

class Session {

    private static $initialize = false;

    public  function __construct() {
        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        //self::setLastVisitedUrl($_SERVER['REQUEST_URI']);

    }

    public static function initialize() {
        if(!self::$initialize) {
            new self();
            self::$initialize = true;
        }
        //session_start();
    }

    public static function setLastVisitedUrl($url) {
        
        $_SESSION['previous_url'] = $url;
    }

    public static function previousURL(){
        
        if(isset($_SESSION['previous_url'])) {
            return $_SESSION['previous_url'];
        }
        return null;
    }

    public static function put($key, $val){
        $_SESSION[$key] = $val;
    }

    public static function get($key){
        return $_SESSION[$key] ?? null;
    }

    public static function forget($key) {
        unset($_SESSION[$key]) ; 
    }


    public static function flash($key, $value = null) {
        
        self::initialize();

        if ($value !== null) {
            // Set session data
            $_SESSION['flash'][$key] = $value;
        } else {
            return $_SESSION['flash'][$key];
            // Display and clear session data
            if (isset($_SESSION['flash'][$key])) {
                $data = $_SESSION['flash'][$key];
                unset($_SESSION['flash'][$key]);
                return $data;
            }
        }
    }

}