<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all(); 
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

        Post::create($validated);

        return redirect()->route('posts')->with('success', 'Artikl yaradıldı!');
    }
}