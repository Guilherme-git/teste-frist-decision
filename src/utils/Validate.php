<?php

namespace src\utils;

class Validate
{
    public function emptyInputs($name, $email, $password)
    {
        if(empty(trim($name)) || empty(trim($email)) || empty(trim($password)))
        {
           return false;
        }
        return true;
    }
    public function validateName($name)
    {
        if(strlen($name) < 3 ||strlen($name) > 50 ) {
            return false;
        }
        return true;
    }
    public function validatePassword($password)
    {
        if(strlen($password) < 6 ||strlen($password) > 20 ) {
            return false;
        }
        return true;
    }

    public function equalsPassword($password, $confirmPassword)
    {
        if($password != $confirmPassword) {
           return false;
        }
        return true;
    }

    public function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }
}