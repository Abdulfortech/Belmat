<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElectionResult extends Model
{
    //
    protected $fillable = [
        'user_id',
        'election_id',
        'state_id',
        'local_government_id',
        'ward_id',
        'polling_unit_id',
        'election_type_id',
        'political_party_id',
        'votes',
        'media',
        'description',
        'status',
    ];

    public function user() { return $this->belongsTo(User::class); }

    public function election() { return $this->belongsTo(Election::class); }

    public function state() { return $this->belongsTo(State::class); }

    public function localGovernment() { return $this->belongsTo(LocalGovernment::class); }

    public function ward() { return $this->belongsTo(Ward::class); }

    public function pollingUnit() { return $this->belongsTo(PollingUnit::class); }

    public function electionType() { return $this->belongsTo(ElectionType::class); }

    public function politicalParty() { return $this->belongsTo(PoliticalParty::class); }

}
