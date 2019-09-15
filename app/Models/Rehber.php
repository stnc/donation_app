<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rehber extends Model
{

  protected $table = 'rehber';
  protected $fillable = ['telefon','ad_soyad','ad','soyad','referans','adres','dogum','yildonumu','add_user_id','add_method','relation_id'];

}
