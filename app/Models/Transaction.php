<?php

namespace App\Models;

class Transaction
{
    protected $table = "transactions";

    protected $fillable = [
        'id',
        'id_customer',
        'id_product',
        'date'
    ];
}
