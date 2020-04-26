<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminVerify extends Model
{
    protected $table = 'admin_verify';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
