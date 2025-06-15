<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalGovernment extends Model
{
    protected $fillable = [
        'title',
        'state_id',
        'code',
        'status',
    ];

    public function state() { return $this->belongsTo(State::class); }

    public function wards() { return $this->hasMany(Ward::class); }

    public function pollingUnits() { return $this->hasMany(PollingUnit::class); }
}
