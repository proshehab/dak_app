<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DakTrack extends Model
{


    protected $fillable = ['dak_address_id', 'status', 'remarks', 'location', 'scanned_by'];

    public function dak()
    {
        return $this->belongsTo(DakAddress::class);
    }
    public function scanner()
    {
        return $this->belongsTo(Admin::class, 'scanned_by');
    }
}