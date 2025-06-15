<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'title',
        'code',
        'status',
    ];

    public function localGovernments() { return $this->hasMany(LocalGovernment::class); }

    public function wards() { return $this->hasMany(Ward::class); }

    public function pollingUnits() { return $this->hasMany(PollingUnit::class); }
}
