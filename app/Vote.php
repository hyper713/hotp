<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'votes';
    protected $primaryKey = 'id_vote';
    public $timestamps = true;
}
