<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    protected $fillable = [
        'election_id',
        'user_id',
        'ward_id',
        'local_government_id',
        'content',
        'media',
        'location',
        'description',
        'status',
    ];

    public function user() { return $this->belongsTo(User::class); }

    public function election() { return $this->belongsTo(Election::class); }

    public function ward() { return $this->belongsTo(Ward::class); }

    public function localGovernment() { return $this->belongsTo(LocalGovernment::class); }
}
