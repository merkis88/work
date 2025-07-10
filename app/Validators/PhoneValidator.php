<?php

namespace App\Validators;

class PhoneValidator
{
    public static function validatePhone($phone)
    {
        return preg_match('/^\+7\d{10}$/', $phone);
    }
}
