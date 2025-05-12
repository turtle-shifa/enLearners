<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// app/Models/Message.php

class Message extends Model
{
    protected $fillable = ['sender_id', 'receiver_id', 'message'];
}
