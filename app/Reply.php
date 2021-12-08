<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['post_id', 'user_id', 'body'];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
