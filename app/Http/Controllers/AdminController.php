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

    public function users()
    {
        $users = User::with('posts', 'comments')->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function posts()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('admin.posts', compact('posts'));
    }

    public function comments()
    {
        $comments = Comment::with('user', 'post')->latest()->paginate(10);
        return view('admin.comments', compact('comments'));
    }

    public function showPost(Post $post)
    {
        $post->load('user', 'comments.user');
        return view('admin.show-post', compact('post'));
    }

    public function createPost()
    {
        return view('admin.create-post');
    }

    public function editPost(Post $post)
    {
        return view('admin.edit-post', compact('post'));
    }

    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:blogger,admin'
        ]);

        $user->update(['role' => $request->role]);

        return response()->json(['success' => true]);
    }

    public function updatePostCategory(Request $request, Post $post)
    {
        $request->validate([
            'category' => 'required|in:shonen,shojo,seinen,josei,kodomomuke'
        ]);

        $post->update(['category' => $request->category]);

        return response()->json(['success' => true]);
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }

    public function deletePost(Post $post)
    {
        if ($post->image && $post->image !== 'posts_images/default.jpg') {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return back()->with('success', 'Post deleted successfully');
    }

    public function deleteComment(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment deleted successfully');
    }
}
