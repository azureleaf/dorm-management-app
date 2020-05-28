<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleHistory extends Model
{
    protected $table = "role_histories";
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function roleTitle()
    {
        return $this->belongsTo('App\RoleTitle');
    }
}
