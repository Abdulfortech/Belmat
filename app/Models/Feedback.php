<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback'; // Laravel would default to 'feedbacks'

    protected $fillable = [
        'user_id',
        'message',
        'media',
        'status',
    ];

    public function user() { return $this->belongsTo(User::class); }
}
