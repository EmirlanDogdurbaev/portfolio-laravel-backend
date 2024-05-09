<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'notes',
        'term',
        'price',
        'tools',
    ];

    protected $casts = [
        'tools' => 'array',
    ];
}
