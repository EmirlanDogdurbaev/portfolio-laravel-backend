<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPage extends Model
{
    use HasFactory;

    protected $table = 'project_pages';

    protected $fillable = [
        'title',
        'mini_description',
        'description',
        'tools',
    ];

    protected $casts = [
        'tools' => 'array',
    ];
}
