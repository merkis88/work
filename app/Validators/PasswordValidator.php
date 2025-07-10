<?php

namespace App\Validators;

class PasswordValidator
{
    public static function validatePassword($password)
    {
        return strlen($password) >= 4;
    }
}
