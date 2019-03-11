<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Event extends Model
{
    public function ticket(){
        return $this->hasMany('App\Ticket');
    }

}
