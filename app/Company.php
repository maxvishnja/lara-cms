<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    protected $revisionEnabled = true;
    protected $revisionCleanup = true;
    protected $revisionCreationsEnabled = true;
    protected $historyLimit = 500;
    protected $dontKeepRevisionOf = array(
        'date_of_contract',
        'avatar',
        'description',
        'discount',
    );
    protected $revisionFormattedFieldNames = array(
        'name' => 'Название',
        'email' => 'Email',
        'phone' => 'Телефон',
        'skype' => 'Скайп',
        'created_at' => 'Дата создания',
    );

    protected $fillable = [
        'type_id', 'name', 'email', 'phone', 'skype', 'discount', 'description', 'manager', 'date_of_contract', 'avatar'
    ];
}
