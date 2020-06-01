<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DormAccountTitle extends Model
{
    protected $table = "dorm_account_titles";

    public function dormBalances()
    {
        return $this->hasMany('App\DormBalance');
    }
}
