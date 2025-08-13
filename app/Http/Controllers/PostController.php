<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index', 'show']),
        ];
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::latest();
        
        // Filter by category if provided
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }
        
        $posts = $query->paginate(6);
        
        // Append query parameters to pagination links
        $posts->appends($request->query());
        
        return view('posts.index', [
            'posts' => $posts,
            'selectedCategory' => $request->get('category', 'all')
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
        // Validate
        $request->validate([
            'title' => ['required', 'max:255'],
            'category' => ['required', 'in:shonen,shojo,seinen,josei,kodomomuke'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'max:3000', 'mimes:webp,png,jpg'] 
        ]);

        // Store image if exists
        $path = null;
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('posts_images', $request->image);
        }

        // Create a post
        Auth::user()->posts()->create([
            'title' => $request->title,
            'category' => $request->category,
            'body' => $request->body,
            'image' => $path
        ]);

        // Redirect to dashboard
        return back()->with('success', 'The post was created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load('comments.user');

        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Authorizing the action
        Gate::authorize('modify', $post);

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Authorizing the action
        Gate::authorize('modify', $post);
        
        // Validate
        $request->validate([
            'title' => ['required', 'max:255'],
            'category' => ['required', 'in:shonen,shojo,seinen,josei,kodomomuke'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'max:3000', 'mimes:webp,png,jpg']  
        ]);

        // Store image if exists
        $path = $post->image ?? null;
        if ($request->hasFile('image')) {
            if ($post->image && $post->image != 'posts_images/default.jpg') {
                Storage::disk('public')->delete($post->image);
            }
            $path = Storage::disk('public')->put('posts_images', $request->image);
        }

        // Update a post
        $post->update([
            'title' => $request->title,
            'category' => $request->category,
            'body' => $request->body,
            'image' => $path
        ]);

        // Redirect to corresponding page
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.posts')->with('success', 'The post was updated successfully!');
        }
        return redirect()->route('dashboard')->with('success', 'Your post was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Authorizing the action
        Gate::authorize('modify', $post);

        // Delete post image if it exists
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        // Delete the post
        $post->delete();

        // Redirect to previous page
        return back()->with('delete', 'The post was deleted!');
    }

    
    // Toggle like for a post (authenticated users only)
     
    public function toggleLike(Post $post)
    {
        $user = Auth::user();
        
        if ($post->isLikedBy($user)) {
            // Unlike: remove from post user likes table and decrease likes count
            $user->likedPosts()->detach($post->id);
            $post->decrement('likes');
            $isLiked = false;
        } else {
            // Like: add to post user likes table and increase likes count
            $user->likedPosts()->attach($post->id);
            $post->increment('likes');
            $isLiked = true;
        }
        
        return response()->json([
            'likes' => $post->fresh()->likes,
            'isLiked' => $isLiked
        ]);
    }

    // Store a newly created comment in db
    public function storeComments(Request $request, Post $post)
    {
        // Validate
        $request->validate([
            'comment' => ['required', 'string', 'max:1500']
        ]);

        // Create a comment
        $post->comments()->create([
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);

        // Redirect to previous page
        return back()->with('success', 'Your comment was created!');
    }
}
