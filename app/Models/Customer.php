<?php

namespace App\Models;

class Customer
{
    protected $table = "customers";

    protected $fillable = [
        'id',
        'fio',
        'email',
        'phone'
    ];
}
