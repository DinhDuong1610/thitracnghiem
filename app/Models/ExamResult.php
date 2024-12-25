<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    protected $fillable = [ 'point', 'time', 'user_id', 'post_id' ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
