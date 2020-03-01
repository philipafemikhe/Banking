<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'account';
    protected $fillable = [
        'account_no', 'account_name', 'account_signatory', 'balance',
    ];
}
