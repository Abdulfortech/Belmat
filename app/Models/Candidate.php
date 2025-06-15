<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'name',
        'election_id',
        'political_party_id',
        'position',
        'bio',
        'status',
    ];

    public function election() { return $this->belongsTo(Election::class); }

    public function politicalParty() { return $this->belongsTo(PoliticalParty::class); }
}
