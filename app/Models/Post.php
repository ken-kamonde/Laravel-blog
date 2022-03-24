<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'
    ];

    public function likedBy(User $user){
        return $this->likes->contains('user_id', $user->id);
    }

    public function User() {
        return $this->belongsTo(user::class);
    }

    public function Likes() {
        return $this->hasMany(Like::class);
    }
}
