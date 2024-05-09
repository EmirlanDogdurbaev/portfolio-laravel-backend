<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'name',
        'position',
        'tools',
        'education',
        'github',
    ];

    protected $casts = [
        'photo' => 'array',
        'position' => 'array',
        'tools' => 'array',
        'education' => 'array',
    ];
}
