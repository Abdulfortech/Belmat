<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'title',
        'author',
        'short_desc',
        'content',
        'media',
        'status',
    ];

    public function images() { return $this->hasMany(Image::class); }

    public function videos() { return $this->hasMany(Video::class); }

    public function events() { return $this->hasMany(Event::class); }
}
