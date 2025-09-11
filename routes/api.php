<?php

use App\Enum\PostStatus;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//featured posts that are published
Route::get('/posts/featured', function () {
    $posts = Post::whereNotNull('featured_at')
        ->where('status', PostStatus::Published)
        ->orderBy('featured_at', 'desc')
        ->get();
    //append images to each post from media collection
   $posts = $posts->each(function ($post) {
        $post->images = $post->getMedia('images')->map(fn($media) => $media->getUrl());
    });

    //unset media
    $posts->each(function ($post) {
        unset($post->media);
    });
    return response()->json($posts);
});

//all published posts
Route::get('/posts', function () {
    $posts = Post::where('status', PostStatus::Published)
        ->with('tags')
        ->orderBy('created_at', 'desc')
        ->get();
    $posts = $posts->each(function ($post) {
        $post->images = $post->getMedia('images')->map(fn($media) => $media->getUrl());
    });

    //unset media
    $posts->each(function ($post) {
        unset($post->media);
    });
    return response()->json($posts);
});


//show single post by slug
Route::get('/posts/{post:slug}', function (Post $post) {
    if ($post->status !== PostStatus::Published) {
        return response()->json(['message' => 'Post not found'], 404);
    }
    $post->load('tags');
    $post->images = $post->getMedia('images')->map(fn($media) => $media->getUrl());
    unset($post->media);
    return response()->json($post);
});

//subscribe to newsletter
Route::post('/subscribe', function (Request $request) {
    $request->validate([
        'email' => 'required|email|unique:news_letters,email',
    ]);
    $newsletter = \App\Models\NewsLetter::create([
        'email' => $request->email,
        'subscribed' => true,
    ]);
    return response()->json(['message' => 'Subscribed successfully', 'data' => $newsletter]);
});
