<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['question_id', 'user_id', 'answer', 'upvotes', 'downvotes'];

    public function question()
{
    return $this->belongsTo(Question::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

    // Increment the upvote count
    public function upvote()
    {
        $this->increment('upvotes');
    }

    // Increment the downvote count
    public function downvote()
    {
        $this->increment('downvotes');
    }

    // Decrement the upvote count
    public function removeUpvote()
    {
        $this->decrement('upvotes');
    }

    // Decrement the downvote count
    public function removeDownvote()
    {
        $this->decrement('downvotes');
    }

}
