<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitUser extends Model
{

     protected $fillable = [
        'unit_id',
        'email',
        'password',
    ];
    
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
