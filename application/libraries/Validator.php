<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Dinum
 * Login Controller
 */
class Validator {
    
    function validate_alpha($text)
    {
        return preg_match("/^[A-Za-z0-9_-]+$/", $text);
    }
    
    function validate_email($text)
    {
        return filter_var($text, FILTER_VALIDATE_EMAIL);
    }
    
    function validate_pw($password){
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);

        if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
          return false;
        } else {
            return true;
        }
    }
}
