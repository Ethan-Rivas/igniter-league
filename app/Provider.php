<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Use Provider Model for relationship
use App\User;

class Provider extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider_id', 'provider_url', 'user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'provider_id'
    ];

    public function users() {
        return $this->hasMany('App\User ');
    }
}
