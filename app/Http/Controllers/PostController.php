<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(){
        $posts = Post::where('user_id', Auth::id())->where('status', 'published')->orderBy('published_at', 'desc')->paginate(10);
        return view('posts.index', compact('posts'));

    }

    public function show(Post $post)
    {
        if ($post->status === 'draft' || $post->status === 'scheduled') {
            abort(403, 'Unauthorized');
        }

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'title' => 'required|string|max:60',
            'content' => 'required|string',
            'published_at' => 'nullable|date|after:now',
            'is_draft'     => 'nullable|boolean',
        ]);

        $validated['is_draft'] = $request->has('is_draft');

        if ($request->has('is_draft')) {
            $status = 'draft';
            $published_at = null;
        } elseif ($request->published_at != null && $request->published_at > Carbon::now()) {
            $status = 'scheduled';
            $published_at = $request->published_at;
        } else {
            $status = 'published';
            $published_at = Carbon::now();
        }

        Post::create([
            'user_id'=> $request->user_id,
            'title' => $request->title,
            'description' => $request->content,
            'status' => $status,
            'published_at' => $published_at,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403, 'Unauthorized');
        }

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403, 'Unauthorized');
        }
        $request->validate([
            'title' => 'required|string|max:60',
            'content' => 'required|string',
        ]);

        if($request->published_at != null && $request->published_at > Carbon::now()) {
            $status = 'scheduled';
            $published_at = $request->published_at;
        } else {
            $status = 'published';
            $published_at = $post->published_at;
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->content,
            'published_at' => $published_at,
            'status' => $status,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403, 'Unauthorized');
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
