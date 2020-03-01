<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'accountNo', 'customer', 'dc', 'amount',
    ];
}
