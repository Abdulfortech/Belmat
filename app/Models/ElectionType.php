<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElectionType extends Model
{
    protected $fillable = [
        'title',
        'status',
    ];
}
