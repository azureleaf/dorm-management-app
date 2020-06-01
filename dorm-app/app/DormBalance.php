<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DormBalance extends Model
{
    protected $table = "dorm_balances";

    public function fundTitles()
    {
        return $this->belongsTo('App\FundTitle');
    }

    public function dormAccountTitles()
    {
        return $this->belongsTo('App\DormAccountTitle');
    }
}
