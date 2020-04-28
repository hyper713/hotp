<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCode extends Model
{
    protected $table = 'user_code';
    protected $primaryKey = 'id_code';
    public $timestamps = false;
}
