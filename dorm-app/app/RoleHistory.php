<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleHistory extends Model
{
    protected $table = "role_histories";
    
    protected $appends = [
        'readable_term'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function roleTitle()
    {
        return $this->belongsTo('App\RoleTitle');
    }

    public function getReadableTermAttribute()
    {
        return "{$this->fiscal_year}年度{$this->term}期";
    }
}
