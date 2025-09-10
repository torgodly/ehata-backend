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

    return response()->json($posts);
});

//all published posts
Route::get('/posts', function () {
    $posts = Post::where('status', PostStatus::Published)
        ->orderBy('created_at', 'desc')
        ->get();
    return response()->json($posts);
});
