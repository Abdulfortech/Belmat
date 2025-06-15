<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'campaign_id',
        'title',
        'short_desc',
        'date',
        'content',
        'location',
        'media',
        'status',
    ];

    public function campaign() { return $this->belongsTo(Campaign::class); }

    public function images() { return $this->hasMany(Image::class); }

    public function videos() { return $this->hasMany(Video::class); }
}
