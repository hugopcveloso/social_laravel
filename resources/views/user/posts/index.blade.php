@extends('layouts.app')

@section('content')
  <div class="flex justify-center p-6">
    <div class="p-6">
      <h1 class="text-2xl font-medium mb-1"> {{ $user->name }}</h1>
      <p>{{ $posts->count() }} {{ Str::plural('post', $posts->count()) }}
        and received {{ $user->receivedLikes->count() }} {{ Str::plural('like', $user->receivedLikes->count()) }}
      </p>
    </div>
    <div class="w-8/12 bg-white p-6 rounded-lg">
      @if ($posts->count())
        @foreach ($posts as $post)
            <div class="mb-4">
              <a href="{{ route('user.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a> 
              <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
              <p class="mb-2">{{ $post->body }}</p>
          
              @can('delete', $post)
                  <div>
                  <form action="{{ route('posts.destroy', $post) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-blue-500">Delete</button>
                  </form>
                  </div>
              @endcan
          
              <div class="flex items-center">
                  @auth
                  @if(!$post->likedBy(auth()->user()))
                  <form action="{{ route('posts.likes', $post) }}" method="post" class="text-blue-500">
                      @csrf
                      <button type="submit" method="post" class="mr-1">Like</button>
                  </form>
                  @else
                  <form action="{{ route('posts.likes', $post) }}" method="post" class="text-blue-500">
                      @csrf
                      @method('DELETE') 
                      {{-- @method is method spoofing  --}}
                      <button type="submit" method="post" class="mr-1">Unlike</button>
                  </form>
                  @endif
          
          
                  @endauth
                  <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
                  
              </div>
          </div>
        @endforeach

      @else 
        <p> {{ $user->name }} doesn't have any posts</p>
      @endif
    </div>
  </div>
@endsection