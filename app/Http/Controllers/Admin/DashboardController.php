<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Tag;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBlogs = Blog::count();
        $totalCategories = Category::count();
        $totalTags = Tag::count();
        $totalViews = Blog::sum('views');
        $totalLikes = Like::count();
        $totalComments = Comment::count();
        $totalUsers = User::count();

        $topBlogs = Blog::orderByDesc('views')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalBlogs',
            'totalCategories',
            'totalTags',
            'totalViews',
            'totalLikes',
            'totalComments',
            'totalUsers',
            'topBlogs'
        ));
    }
}