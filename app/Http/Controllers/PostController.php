<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
    
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
    
        $image = $request->file('image');
        $imageName = 'postimages'.'/'.time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('postimages'), $imageName);
    
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageName,
        ]);
    
        return redirect()->route('home')->with('success', 'Post created successfully.');
    }
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

   
public function update(Request $request, Post $post)
{

    $request->validate([
        'title' => 'required',
        'content' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    if ($request->hasFile('image')) {
        if ($post->image) {
            $oldImagePath = public_path($post->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $image = $request->file('image');
        $imageName = 'postimages/' . time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('postimages'), $imageName);
    } else {
        $imageName= $post->image;
    }

    $post->update([
        'title' => $request->title,
        'content' => $request->content,
        'image' => $imageName,
    ]);

    return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
}
    public function destroy(Post $post)
    {
        if ($post->image) {
            $oldImagePath = public_path($post->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
