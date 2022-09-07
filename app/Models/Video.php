<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'file',
        'likes',
        'dislikes',
        'ban_status'
    ];

    protected $table = 'videos';
}
