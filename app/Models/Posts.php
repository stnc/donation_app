<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{

  protected $fillable = ['post_title','post_content','media_picture','post_author','post_status','post_order'];



/*
    public function likes()
    {
        return $this->morphMany(A_book_author_like::class, 'liketable');
    }*/

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }


    public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable');
    }



    public function categories()
    {
        return $this->belongsToMany(Category::class, 'posts_categories_relations',  'post_id','category_id')
            ->withTimestamps();
    }

    public function user()
    {
        return  $this->hasOne(User::class);
    }


}
