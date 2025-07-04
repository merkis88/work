<?php

namespace App\Model;

use illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password'
    ];

    public $appends = true;
}