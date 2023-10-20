<?php

namespace Core;

class Validator {
    

    public static function validate(array $data, array $rules){

        $errors = [];

        foreach ($rules as $field => $rule) {
            $ruleArray = explode('|', $rule);

            foreach ($ruleArray as $singleRule) {
                switch ($singleRule) {
                    case 'required':
                        if (empty($data[$field])) {
                            $errors[$field][] = "The $field field is required.";
                        }
                        break;

                    case 'email':
                        if (!filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                            $errors[$field][] = "The $field field must be a valid email address.";
                        }
                        break;

                    // Add more validation rules using additional cases
                    case strpos($singleRule, 'min:') === 0:
                        $minLength = (int) substr($singleRule, 4);
                        if (strlen($data[$field]) < $minLength) {
                            $errors[$field][] = "The $field field must be at least $minLength characters long.";
                        }
                        break;

                    // Handle other validation rules

                    default:
                        // Unknown rule
                        break;
                }
            }
        }

        return $errors;
        
    }
    
}