<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    protected $revisionEnabled = true;
    protected $revisionCleanup = true;
    protected $revisionCreationsEnabled = false;
    protected $historyLimit = 200;
    protected $dontKeepRevisionOf = array(
        'date_of_contract',
        'avatar',
        'description',
        'discount',
        'manager',
    );

    protected $fillable = [
        'type_id', 'name', 'email', 'phone', 'skype', 'discount', 'description', 'manager', 'date_of_contract', 'avatar'
    ];
}
