<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DakAddress extends Model
{
    protected $fillable = [
        'unit_user_id',
        'unit_id',
        'from_address',
        'letter_no',
        'security_type',
        'to_name',
        'to_address',
        'date',
        'barcode',
        'status',
        'remarks'
    ];

    public function unitUser()
    {
        return $this->belongsTo(UnitUser::class, 'unit_user_id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function unitPeople()
    {
        return $this->belongsToMany(UnitPeople::class, 'unit_people_dak_address', 'dak_address_id', 'unit_people_id');
    }
}