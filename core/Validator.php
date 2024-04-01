<?php

namespace Core;

class Validator {
    

    protected static $errors = [];

    public static function validate(array $data, array $rules) {
        foreach ($rules as $field => $rule) {
            $rulesArray = explode('|', $rule);
            foreach ($rulesArray as $singleRule) {
                $parts = explode(':', $singleRule);
                $method = 'validate' . ucfirst($parts[0]);
                $value = isset($data[$field]) ? $data[$field] : null;

                if (method_exists(self::class, $method)) {
                    self::$method($field, $value, $parts);
                }
            }
        }

        return self::errors();
        
    }

    protected static function addError($field, $message) {
        self::$errors[$field][] = $message;
    }

    public static function errors() {
        return self::$errors;
    }

    // Define validation methods like validateRequired, validateEmail, etc.
    protected static function validateRequired($field, $value, $parts) {
        if (empty($value)) {
            self::addError($field, "The $field field is required.");
        }
    }
    
    protected static function validateEmail($field, $value, $parts) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            self::addError($field, "The $field field must be a valid Email.");
        }
    }
    
}