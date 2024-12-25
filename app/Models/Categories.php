<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [ 'name' ];

    public function posts() {
        return $this->hasMany(Post::class, 'cat_id');
    }
}