<?php

namespace Core;
class Redirect
{
    protected static $url;
    protected static $data = [];

    public static function to($url)
    {
        self::$url = $url;
        return new self();
    }

    public static function back()
    {
        self::$url = $_SERVER['HTTP_REFERER'];
        return new self();
    }

    public function with($key, $message)
    {
        self::$data[$key] = $message;
        return $this;
    }

    public function withErrors(array $errors) 
    {
        self::$data['errors'] = $errors;
        return $this;
    }

    public function __destruct()
    {
        if (!empty(self::$data)) {
            session_start();
            foreach (self::$data as $key => $value) {
                $_SESSION[$key] = $value;
            }
        }
        header('Location: ' . self::$url);
        exit;
    }
}
