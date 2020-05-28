<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** 
     * By adding the accessor as follows, this accessor value will be
     * dynamically appended on every model retrieval
     */
    protected $appends = [
        'full_name'
    ];

    // A user can have only one room
    public function room()
    {
        return $this->hasOne('App\Room');
    }

    // A user can have multiple role histories
    public function roleHistories()
    {
        return $this->hasMany('App\RoleHistory');
    }

    // Accessor
    // By naming the function as follows, the value can be accessed as "$user->full_name"
    // Don't forget to add accessor to "$appends"
    public function getFullNameAttribute()
    {
        return "{$this->name_family_kanji}{$this->name_first_kanji}";
    }
}
