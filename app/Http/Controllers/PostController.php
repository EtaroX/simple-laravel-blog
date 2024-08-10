<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::where('user_id', '!=', Auth::user()->id)
                ->orderByDesc('updated_at')
                ->with('user')
                ->paginate(20),
        ]);
    }

    public function dashboard()
    {
        return view('dashboard', [
            'posts' => Auth::user()->posts()->orderByDesc('updated_at')->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post->load('user'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post->load('user'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update($request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'tag' => 'nullable|string|max:255',
            'photo' => 'nullable|image',
        ]));

        return redirect()->route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('dashboard');
    }
}
