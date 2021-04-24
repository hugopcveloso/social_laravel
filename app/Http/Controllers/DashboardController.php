<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        //dd(auth()->user());
        // dd(auth()->user()->posts);
        //dd(Post::find(2)->created_at);
        return view('dashboard');
    }
}