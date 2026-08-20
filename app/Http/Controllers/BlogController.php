<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with(['category', 'tags'])
            ->withCount(['likes', 'comments'])
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Sort
        $sort = $request->input('sort', 'newest');

        if ($sort === 'az') {

            $query->orderBy('title', 'asc');
        } elseif ($sort === 'oldest') {

            $query->orderBy('published_at', 'asc');
        } else {

            $query->orderBy('published_at', 'desc');
        }

        $blogs = $query
            ->paginate(9)
            ->withQueryString();

        return view('blogs.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::with([
            'category',
            'tags',
            'user',
            'likes',
            'comments' => function ($query) {
                $query->where('is_visible', true)
                    ->with('user')
                    ->latest();
            },
        ])
            ->where('slug', $slug)
            ->firstOrFail();

        $blog->increment('views');

        $relatedBlogs = Blog::with(['category'])
            ->where('id', '!=', $blog->id)
            ->whereHas('tags', function ($query) use ($blog) {
                $query->whereIn(
                    'tags.id',
                    $blog->tags->pluck('id')
                );
            })
            ->latest()
            ->take(3)
            ->get();

        $liked = auth()->check()
            ? $blog->likes()
            ->where('user_id', auth()->id())
            ->exists()
            : false;

        // Blog content
        $content = $blog->content;

        // Generate Table of Contents from <h2> headings
        preg_match_all(
            '/<h2[^>]*>(.*?)<\/h2>/is',
            $content,
            $matches
        );

        $toc = [];

        foreach ($matches[1] ?? [] as $index => $heading) {

            $title = trim(strip_tags($heading));

            $id = 'section-' . ($index + 1);

            $toc[] = [
                'id' => $id,
                'title' => $title,
            ];

            $content = preg_replace(
                '/<h2([^>]*)>(.*?)<\/h2>/is',
                '<h2$1 id="' . $id . '">$2</h2>',
                $content,
                1
            );
        }

        return view('blogs.show', compact(
            'blog',
            'relatedBlogs',
            'liked',
            'content',
            'toc'
        ));
    }
}
