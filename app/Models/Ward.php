<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $fillable = [
        'title',
        'local_government_id',
        'state_id',
        'status',
    ];

    public function localGovernment() { return $this->belongsTo(LocalGovernment::class); }

    public function state() { return $this->belongsTo(State::class); }

    public function pollingUnits() { return $this->hasMany(PollingUnit::class); }
}
