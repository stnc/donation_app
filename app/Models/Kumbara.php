<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kumbara extends Model
{

  protected $fillable =['id', 'rehber_id',  'city_id', 'town_id', 'referans','miktar','meslek','email','aciklama','add_user_id'];
  protected $table ='kumbara';
    // public function tags()
    // {
    //     return $this->morphToMany(Tag::class, 'taggable');
    // }


    // public function comments()
    // {
    //     return $this->morphMany(Comments::class, 'commentable');
    // }



    // public function categories()
    // {
    //     return $this->belongsToMany(Category::class, 'posts_categories_relations',  'post_id','category_id')
    //         ->withTimestamps();
    // }

    public function user()
    {
        return  $this->hasOne(User::class);
    }


}
