<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollingUnit extends Model
{
    protected $fillable = [
        'title',
        'code',
        'ward_id',
        'local_government_id',
        'state_id',
        'status',
    ];

    public function ward() { return $this->belongsTo(Ward::class); }

    public function localGovernment() { return $this->belongsTo(LocalGovernment::class); }

    public function state() { return $this->belongsTo(State::class); }
}
