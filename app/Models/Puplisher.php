<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Puplisher extends Model
{
    protected $guarded = array();
    protected $table = "puplishing_house";

    public function book()
    {
        return $this->belongsTo(A_books::class,'puplishing_house_id');
    }

    public function books()
    {
        return $this->belongsToMany(A_books::class, 'books_puplisher_relations',  'puplisher_id','book_id')
        ->withTimestamps();
    }
}
