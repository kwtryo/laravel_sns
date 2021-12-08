<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['post_tag', 'name'];
    
    public function posts(){
        return $this->belongsToMany('App\Post');
    }
}
