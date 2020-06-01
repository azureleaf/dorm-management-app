<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundTitle extends Model
{
    protected $table = "fund_titles";

    public function dormBalances()
    {
        return $this->hasMany('App\DormBalance');
    }
}
