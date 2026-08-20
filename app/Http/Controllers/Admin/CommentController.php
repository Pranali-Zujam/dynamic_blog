<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index(Request $request)
    {
        $query = Comment::with(['user', 'blog'])
            ->latest();

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('comment', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('blog', function ($blogQuery) use ($search) {
                        $blogQuery->where('title', 'like', '%' . $search . '%');
                    });

            });
        }

        // Filter by visibility
        if ($request->filled('status')) {

            if ($request->status === 'visible') {
                $query->where('is_visible', true);
            }

            if ($request->status === 'hidden') {
                $query->where('is_visible', false);
            }
        }

        $comments = $query
            ->paginate(10)
            ->withQueryString();

        return view('admin.comments.index', compact('comments'));
    }



    public function hide(Comment $comment)
    {
        $comment->update([
            'is_visible' => false,
        ]);

        return back()->with(
            'success',
            'Comment hidden successfully.'
        );
    }



    public function show(Comment $comment)
    {
        $comment->update([
            'is_visible' => true,
        ]);

        return back()->with(
            'success',
            'Comment is now visible.'
        );
    }


 
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()->with(
            'success',
            'Comment deleted successfully.'
        );
    }
}