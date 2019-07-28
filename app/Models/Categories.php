<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $guarded = array();
    protected $table = "posts_categories";

    public function posts()
    {
        return $this->belongsToMany(Posts::class, 'posts_categories_relations', 'category_id', 'post_id')
            ->withTimestamps();
    }
}

