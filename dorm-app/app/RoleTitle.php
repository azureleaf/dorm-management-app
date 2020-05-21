<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleTitle extends Model
{
    protected $table = "role_titles";

    // Set default values
    protected $attributes = [
        'reward_amount' => 0,
        'reward_unit' => "jpy",
    ];
    
}
