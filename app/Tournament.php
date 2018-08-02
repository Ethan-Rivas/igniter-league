<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Softdelete
use Illuminate\Database\Eloquent\SoftDeletes;

class Tournament extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'provider_id', 'tournament_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'tournament_code'
    ];

    /**
      * The attributes that should be mutated to dates.
      *
      * @var array
      */
    protected $dates = ['deleted_at'];
  }
