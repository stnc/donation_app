<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
    ];

    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = \Hash::make($value);
    }

    public function getId()
    {

/*

        create database magento2devdb;
create user beondevuser@localhost identified by 'mAgw34herero344#3545454dev';
grant all privileges on magento2devdb.* to beondevuser@localhost identified by 'mAgw34herero344#3545454dev';
flush privileges;

*/

        return $this->id;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function  blog()
    {
        return $this->hasMany(Blog::class);
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function usersDetail()
    {
        return $this->hasOne(UserDetail::class,'user_id');
    }
}
