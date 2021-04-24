<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Post $post, Request $request)
    {
        if ($post->likedBy($request->user())) {
            return response(null, 409); //conflict http
        }

        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);
        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        $request
            ->user() //goest through the user
            ->likes() // picks all the likes
            ->where('post_id', $post->id) //where the post_id is the one we passed
            ->delete(); //deletes it

        return back();
    }
}