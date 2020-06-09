<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Billing extends Model
{
    protected $table = "billings";

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function billingDetails()
    {
        return $this->hasMany('App\BillingDetail');
    }

    protected $appends = [
        'abstract'
    ];

    public function getAbstractAttribute()
    {
        $closedAt = Carbon::parse($this->closed_at);
        $month2digits = $closedAt->month > 9 ? $closedAt->month : "0" . strval($closedAt->month);
        return "{$closedAt->year}年{$month2digits}月分";
    }
}
