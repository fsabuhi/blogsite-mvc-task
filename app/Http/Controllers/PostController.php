<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')
            ->where('user_id', auth()->id())
            ->get()
            ->map(function ($post) {
                if ($post->image) {
                    $post->image_url = \Storage::disk('r2')->url($post->image);
                }
                return $post;
            });
    
        return Inertia::render('posts', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return Inertia::render('create_post');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'r2');
            $validated['image'] = $imagePath; 
        }

        $validated['user_id'] = auth()->id();

        Post::create($validated);

        return redirect()->route('posts')->with('success', 'Artikl yaradıldı!');
    }
    public function delete($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image) {
            \Storage::disk('r2')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts')->with('success', 'Artikl silindi!');
    }
}