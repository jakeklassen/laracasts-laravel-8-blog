<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()
                ->with(['category', 'author'])
                ->filter(request(['search', 'category', 'author']))
                ->paginate()
                ->withQueryString(),
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => ['required'],
            'thumbnail' => ['required', 'image'],
            'slug' => ['required', 'unique:posts,slug'],
            'excerpt' => ['required'],
            'body' => ['required'],
            'category_id' => ['required', 'exists:categories,id']
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = Storage::disk('public')->put('thumbnails', request()->file('thumbnail'));

        Post::create($attributes);

        return redirect('/');
    }
}
