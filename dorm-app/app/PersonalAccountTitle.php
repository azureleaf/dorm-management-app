<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalAccountTitle extends Model
{
    protected $table = "personal_account_titles";

    public function billingDetails()
    {
        return $this->hasMany('App\BillingDetails');
    }

    protected $appends = [
        'name_with_id'
    ];

    public function getNameWithIdAttribute()
    {
        return "{$this->id}: {$this->name}";
    }
}
