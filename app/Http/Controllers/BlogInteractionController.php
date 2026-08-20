<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;

class BlogInteractionController extends Controller
{
    public function like(Blog $blog)
    {
        $like = Like::where('user_id', auth()->id())
            ->where('blog_id', $blog->id)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'blog_id' => $blog->id,
            ]);
        }

        return back();
    }

    public function comment(Request $request, Blog $blog)
    {
        $request->validate([
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'blog_id' => $blog->id,
            'comment' => $request->comment,
            'is_visible' => true,
        ]);

        return back()->with('success', 'Comment added successfully.');
    }
}