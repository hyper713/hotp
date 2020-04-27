<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminCode extends Model
{
    protected $table = 'admin_code';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
