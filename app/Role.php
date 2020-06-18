<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes; //línea necesaria

class Role extends Model
{
    //use SoftDeletes; //Implementamos 
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
