<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')
            ->with('user', 'likes')
            ->paginate(20);

        // instead of orderBy('created_at', 'dec') we can also
        // use latest()
        //dd($posts);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);
        $request
            ->user()
            ->posts()
            ->create([
                'body' => $request->body,
            ]);
        return back();
    }
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        //blocks the authorization

        $post->delete();
        return back();
    }
}