<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    protected $fillable = [
        'title',
        'description',
        'election_type_id',
        'date',
        'status',
    ];

    public function electionType() { return $this->belongsTo(ElectionType::class); }

    public function candidates() { return $this->hasMany(Candidate::class); }

    public function results() { return $this->hasMany(ElectionResult::class); }

    public function observations() { return $this->hasMany(Observation::class); }

}
