<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Event extends Model
{
    public function ticket(){
        return $this->hasMany('App\Ticket');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function bookmarks(){
        return $this->hasMany('App\Bookmark');
    }
}
