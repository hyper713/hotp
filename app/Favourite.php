<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $table = 'favourites';
    protected $primaryKey = 'id_favourite';
    public $timestamps = true;
}
