<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display the statistic of the system.
     */
    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'posts' => Post::count(),
            'comments' => Comment::count(),
        ];

        // Get posts count by category for chart
        $postsPerCategory = Post::select('category', DB::raw('count(*) as count'))
            ->groupBy('category')
            ->get()
            ->pluck('count', 'category')
            ->toArray();

        return view('admin.dashboard', compact('stats', 'postsPerCategory'));
    }

    /**
     * Display the user information in table.
     */
    public function users()
    {
        $users = User::with('posts', 'comments')->paginate(10);
        return view('admin.users', compact('users'));
    }

    /**
     * Display the post information in table.
     */
    public function posts()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('admin.posts', compact('posts'));
    }

    /**
     * Display the comment information in table.
     */
    public function comments()
    {
        $comments = Comment::with('user', 'post')->latest()->paginate(10);
        return view('admin.comments', compact('comments'));
    }

    /**
     * Display the specified resource.
     */
    public function showPost(Post $post)
    {
        $post->load('user', 'comments.user');
        return view('admin.show-post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editPost(Post $post)
    {
        return view('admin.edit-post', compact('post'));
    }

    /**
     * Update the role of a specific user.
     */
    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:blogger,admin'
        ]);

        $user->update(['role' => $request->role]);

        return response()->json(['success' => true]);
    }

    /**
     * Update the category of a specific post.
     */
    public function updatePostCategory(Request $request, Post $post)
    {
        $request->validate([
            'category' => 'required|in:shonen,shojo,seinen,josei,kodomomuke'
        ]);

        $post->update(['category' => $request->category]);

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified user from storage.
     */
    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('delete', 'The user was deleted!');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function deleteComment(Comment $comment)
    {
        $comment->delete();
        return back()->with('delete', 'The comment was deleted!');
    }
}
