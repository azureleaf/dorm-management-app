<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillingDetail extends Model
{
    protected $table = "billing_details";
    
    public function billing()
    {
        return $this->belongsTo('App\Billing');
    }

    public function personalAccountTitle()
    {
        return $this->belongsTo('App\PersonalAccountTitle');
    }
}
