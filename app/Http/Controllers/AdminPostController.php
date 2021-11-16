<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post)
    {
        $attributes = request()->validate([
            'title' => ['required'],
            'thumbnail' => ['image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore(($post->id))],
            'excerpt' => ['required'],
            'body' => ['required'],
            'category_id' => ['required', 'exists:categories,id']
        ]);

        if (isset($attributes['thumbnail'])) {
            $attributes['thumbnail'] = Storage::disk('public')->put('thumbnails', request()->file('thumbnail'));
        }

        $post->update($attributes);

        return back()->with('success', 'Post successfully updated');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('success', 'Post deleted');
    }
}
