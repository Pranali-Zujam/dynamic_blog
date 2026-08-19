<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);

        $categories = Category::latest()->get();

        $tags = Tag::latest()->get();

        $totalBlogs = Blog::count();

        $totalCategories = Category::count();

        $totalTags = Tag::count();

        return view('admin.dashboard', compact(
            'blogs',
            'categories',
            'tags',
            'totalBlogs',
            'totalCategories',
            'totalTags'
        ));
    }
}
