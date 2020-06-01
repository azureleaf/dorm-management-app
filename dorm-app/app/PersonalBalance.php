<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalBalance extends Model
{
    protected $table = "personal_balances";

    public function personalAccontTitle()
    {
        return $this->belongsTo('App\PersonalAccountTitle');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
