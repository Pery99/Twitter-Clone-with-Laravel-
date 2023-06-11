<?php
namespace App\Models;

use App\Models\Tweet;
use Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model

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