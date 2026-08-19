<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with(['category', 'tags'])
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(9);

        $categories = Category::orderBy('name')->get();

        return view('blogs.index', compact('blogs', 'categories'));
    }

    public function show($slug)
    {
        $blog = Blog::with(['category', 'tags', 'user'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $blog->increment('views');

        $relatedBlogs = Blog::with('category')
            ->where('status', 'published')
            ->where('id', '!=', $blog->id)
            ->where('category_id', $blog->category_id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blogs.show', compact('blog', 'relatedBlogs'));
    }
}