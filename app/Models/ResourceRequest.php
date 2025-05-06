<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'thumbnail', 'content', 'user_id', 'topic_id'
    ];
}
