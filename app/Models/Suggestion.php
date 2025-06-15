<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    //
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'email',
        'lga_id',
        'state_id',
        'content',
        'media',
        'status',
    ];

    public function user() { return $this->belongsTo(User::class); }
}
