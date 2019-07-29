<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmsTaslaklari extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'sms_taslaklari';
    protected $fillable = ['id','mesaj','durum','add_user_id'];


}
