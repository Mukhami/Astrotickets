<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UsersMetum extends Model
{
    protected $fillable = ['user_id', 'name', 'email', 'phone'];
}
