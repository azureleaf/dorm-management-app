<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $table = "billings";
    
    public function billingDetails()
    {
        return $this->hasMany('App\BillingDetail');
    }
}
