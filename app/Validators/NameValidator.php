<?php

namespace App\Validators;

class NameValidator
{
    public static function validateName($name)
    {
        return !empty($name);
    }
}
