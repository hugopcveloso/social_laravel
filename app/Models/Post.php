<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['body'];

    public function likedBy(User $user)
    {
        //this allows us to check if the collection of likes from this post
        //contains the user we're inputing.
        return $this->likes->contains('user_id', $user->id);
    }

    // public function ownedBy(User $user)
    // {
    //     return $user->id === $this->user_id;
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}