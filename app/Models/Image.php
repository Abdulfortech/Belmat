<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    protected $fillable = [
        'campaign_id',
        'event_id',
        'path',
        'status',
    ];

    public function campaign() { return $this->belongsTo(Campaign::class); }

    public function event() { return $this->belongsTo(Event::class); }

    public function imageable(): MorphTo { return $this->morphTo(); }
}
