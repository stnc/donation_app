<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
   
    protected $table = 'town';
    protected $fillable = ['TownID','CityID','TownName'];


}
