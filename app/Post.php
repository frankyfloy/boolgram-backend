<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','title', 'content', 'image',
    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
