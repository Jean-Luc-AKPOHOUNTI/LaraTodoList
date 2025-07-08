<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'date',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}