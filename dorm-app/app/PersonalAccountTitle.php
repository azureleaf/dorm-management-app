<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalAccountTitle extends Model
{
    protected $table = "personal_account_titles";

    public function personalBalances()
    {
        return $this->hasMany('App\PersonalBalance');
    }
}
