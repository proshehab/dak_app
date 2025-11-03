<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UnitUser extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'unit_id',
        'name',
        'eamil',
        'phone',
        'password',
        'status',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function daks()
    {
        return $this->hasMany(DakAddress::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Tell Laravel which guard this model is tied to (optional, not required here)
    protected $guard = 'unit';
}