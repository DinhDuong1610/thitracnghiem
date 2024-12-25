<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'path_file', 'result', 'time', 'cat_id', 'user_id'
    ];

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'cat_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
