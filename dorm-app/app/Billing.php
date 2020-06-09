<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
