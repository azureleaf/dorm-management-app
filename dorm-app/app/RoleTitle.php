<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleTitle extends Model
{
    protected $table = "role_titles";

    // Set default values
    protected $attributes = [
        'default_reward_pct' => 0,
    ];

    // A user can have multiple role histories
    public function roleHistories()
    {
        return $this->hasMany('App\RoleHistory');
    }
}
