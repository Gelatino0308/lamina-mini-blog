<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index(Request $request) 
    {
        $user = Auth::user();

        // Get total posts count (unfiltered)
        $totalPosts = $user->posts()->count();

        // Build filtered query
        $query = $user->posts()->latest();
        
        // Filter by category if provided
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }
        
        $posts = $query->paginate(6);
        
        // Append query parameters to pagination links
        $posts->appends($request->query());

        return view('users.dashboard', [
            'posts' => $posts,
            'totalPosts' => $totalPosts,
            'selectedCategory' => $request->get('category', 'all')
        ]);
    }

    public function userPosts(User $user, Request $request) 
    {
        $query = $user->posts()->latest();
        
        // Filter by category if provided
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }
        
        $userPosts = $query->paginate(6);
        
        // Append query parameters to pagination links
        $userPosts->appends($request->query());

        return view('users.posts', [
            'posts' => $userPosts,
            'user' => $user,
            'selectedCategory' => $request->get('category', 'all')
        ]);
    }
}
