<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'title',
        'agent_name',
        'agent_phone',
        'votes',
        'media',
        'status',
        'user_id',
        'election_id',
        'election_type',
        'political_party_id',
        'state_id',
        'local_government_id',
        'ward_id',
        'polling_unit_id',
        'constituency_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    public function politicalParty()
    {
        return $this->belongsTo(PoliticalParty::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function localGovernment()
    {
        return $this->belongsTo(LocalGovernment::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function pollingUnit()
    {
        return $this->belongsTo(PollingUnit::class);
    }
}
