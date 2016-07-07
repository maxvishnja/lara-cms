<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'type_id', 'name', 'email', 'phone', 'skype', 'discount', 'description', 'manager', 'date_of_contract', 'avatar'
    ];
}
