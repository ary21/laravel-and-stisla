<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Masters extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value', 'code', 'extra', 'component', 'type',
    ];
    
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
