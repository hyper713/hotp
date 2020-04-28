<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class provider extends Model
{
    protected $table = 'providers';
    protected $primaryKey = 'id_provider';
    public $timestamps = true;
}
