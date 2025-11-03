<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DakAddress extends Model
{
    protected $fillable = [
        'unit_user_id',
        'unit_id',
        'from_address',
        'security_type',
        'letter_no',
        'to_name',
        'to_address',
        'date',
        'barcode',
        'status',
        'remarks'
    ];

    public function unitUser()
    {
        return $this->belongsTo(UnitUser::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function tracks()
    {
        return $this->hasMany(DakTrack::class)->orderBy('scanned_at');
    }

    public function getCurrentStatus()
    {
        return $this->tracks()->latest()->first()?->status ?? $this->status;
    }
}