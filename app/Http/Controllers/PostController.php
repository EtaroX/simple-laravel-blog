<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->query('q')) {
            return view('posts.index', [
                'posts' => Post::where('title', 'like', '%' . $request->query('search') . '%')
                    ->orWhere('body', 'like', '%' . $request->query('search') . '%')
                    ->orWhere('tag', 'like', '%' . $request->query('search') . '%')
                    ->orderByDesc('updated_at')
                    ->with('user')
                    ->paginate(20),
            ]);
        }
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
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'tag' => 'required|string|max:255',
        ]);
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|max:2048',
            ]);
            $data['photo'] = $request->file('photo')->storePublicly('public');
        }
        $post = Auth::user()->posts()->create([...$data, "user_id" => $request->user()->id]);

        return redirect()->route('posts.show', $post);
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

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'tag' => 'required|string|max:255',
        ]);
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|max:2048',
            ]);
            if ($post->photo) {
                File::delete($post->photo);
            }
            $data['photo'] = $request->file('photo')->storePublicly('public');
        }
        $post->update($data);
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

    public function getLikes(string $postId)
    {
        if (!$postId) {
            return response()->json(['message' => 'post_id is required'], 400);
        }
        $post = Post::find($postId);
        if (!$post) {
            return response()->json(['message' => 'post not found'], 404);
        }
        return response()->json(['likes' => $post->likes], 200);
    }

    public function like(Request $request, string $postId)
    {
        if (!$postId) {
            return response()->json(['message' => 'post_id is required'], 400);
        }
        $post = Post::find($postId);
        if (!$post) {
            return response()->json(['message' => 'post not found'], 404);
        }
        if ($post->user_id == $request->user()->id) {
            return response()->json(['message' => 'You cannot like your own post'], 403);
        }
        if ($request->user()->last_like_at && $request->user()->last_like_at->diffInHours() < 1) {
            return response()->json(['message' => 'You can only like/dislike a post once every hour'], 400);
        }
        $post->incrementLikes();
        $request->user()->last_like_at = now();
        $request->user()->save();
        return response()->json(['message' => 'Post liked successfully'], 200);
    }

    public function getDislikes(string $postId)
    {
        if (!$postId) {
            return response()->json(['message' => 'post_id is required'], 400);
        }
        $post = Post::find($postId);
        if (!$post) {
            return response()->json(['message' => 'post not found'], 404);
        }
        return response()->json(['dislikes' => $post->dislikes], 200);
    }
    public function dislike(Request $request, string $postId)
    {
        if (!$postId) {
            return response()->json(['message' => 'post_id is required'], 400);
        }
        $post = Post::find($postId);
        if (!$post) {
            return response()->json(['message' => 'post not found'], 404);
        }
        if ($post->user_id == $request->user()->id) {
            return response()->json(['message' => 'You cannot dislike your own post'], 403);
        }
        if ($request->user()->last_like_at && $request->user()->last_like_at->diffInHours() < 1) {
            return response()->json(['message' => 'You can only like/dislike a post once every hour'], 400);
        }
        $post->incrementDislikes();
        $request->user()->last_like_at = now();
        $request->user()->save();
        return response()->json(['message' => 'Post disliked successfully'], 200);

    }
}
