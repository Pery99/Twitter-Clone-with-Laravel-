<?php

namespace App\Models;

use App\Models\Tweet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model

{

     protected $fillable = [
        'user_id',
        'tweet_id',
        'comment',
        'username',
        'pphoto',
    ];
    use HasFactory;

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function tweets() 
    {
        return $this->belongsTo(Tweet::class);
    }
}
