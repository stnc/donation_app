<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GidenSms extends Model
{
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    protected $table = 'giden_sms';
    protected $fillable = ['id','mesaj','toplam','basarili','basarisiz','bekleyen','mesaj','telefon','rehber_id','add_user_id','sms_taslak_id','sms_dlrId'];


}
