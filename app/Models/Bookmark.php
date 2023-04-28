<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{

    protected $fillable = [
        'tweet_id',
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
