<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        // Only fetch posts for the currently authenticated user
        $posts = Post::with('user')
            ->where('user_id', auth()->id())
            ->get(); 
            
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
            $imagePath = $request->file('image')->store('images', 'public'); 
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
            \Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts')->with('success', 'Artikl silindi!');
    }
}