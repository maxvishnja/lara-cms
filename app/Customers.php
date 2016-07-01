<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'skype', 'discount', 'description', 'manager', 'date_of_contract', 'avatar'
    ];
}
