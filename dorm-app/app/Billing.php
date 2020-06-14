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
        // Fill with 0 to make month strings 2 digits: 08, 09, 10...
        $month2digits = $this->month > 9 ? $this->month : "0" . strval($this->month);
        return "{$this->year}年{$month2digits}月分";
    }
}
