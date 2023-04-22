<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{

    protected $fillable = [
        'pphoto',
        'bio',
    ];
    use HasFactory;

    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false) {
            $query->where('tweets', 'like', '%' . request('search') . '%');
        }
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

  
}
