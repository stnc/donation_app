<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserDetail extends Authenticatable
{
    use Notifiable;

    protected $table='user_detail';




    public function user()
    {
        return $this->belongsTo(User::class)->withTimestamps();
    }


}
