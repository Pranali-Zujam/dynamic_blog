<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{

    //  Display a listing of the resource

    public function index(Request $request)
    {
        $query = Blog::with(['category', 'user', 'tags']);

        // search by title , status, category
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }


        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $blogs = $query->latest()->paginate(10)->withQueryString();

        $categories = Category::orderBy('name')->get();


        return view('admin.blogs.index', compact('blogs', 'categories'));
    }


    //Show the form for creating a new resource.

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('admin.blogs.create', compact('categories', 'tags'));
    }


    //Store a newly created resource in storage.

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug',
            'category_id' => 'required|exists:categories,id',

            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',

            'description' => 'nullable|string',
            'content' => 'required|string',

            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',

            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'canonical_url' => 'nullable|url|max:255',
            'schema_markup' => 'nullable|string',

            'status' => 'required|in:draft,published',
        ]);

        $validated['user_id'] = auth()->id();

        $validated['slug'] = $request->slug
            ? Str::slug($request->slug)
            : Str::slug($request->title);

        if ($request->status === 'published') {
            $validated['published_at'] = now();
        }

        unset($validated['tags']);

        // Create blog first so we get the blog ID
        $blog = Blog::create($validated);

        //  Thumbnail


        if ($request->hasFile('thumbnail')) {

            $extension = $request->file('thumbnail')->getClientOriginalExtension();

            $filename = $blog->id
                . '-' . $blog->slug
                . '-thumbnail.'
                . $extension;

            $path = $request->file('thumbnail')
                ->storeAs('blogs/thumbnails', $filename, 'public');

            $blog->update([
                'thumbnail' => $path
            ]);
        }



        //  Banner


        if ($request->hasFile('banner')) {

            $extension = $request->file('banner')->getClientOriginalExtension();

            $filename = $blog->id
                . '-' . $blog->slug
                . '-banner.'
                . $extension;

            $path = $request->file('banner')
                ->storeAs('blogs/banners', $filename, 'public');

            $blog->update([
                'banner' => $path
            ]);
        }

        //  Tags
        if ($request->has('tags')) {
            $blog->tags()->sync($request->tags);
        }

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog created successfully.');
    }



    //Show the form for editing the specified resource.

    public function edit(Blog $blog)
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $blog->load('tags');
        return view('admin.blogs.edit', compact('blog', 'categories', 'tags'));
    }


    //Update the specified resource in storage.

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',

            'slug' => 'nullable|string|max:255|unique:blogs,slug,' . $blog->id,

            'category_id' => 'required|exists:categories,id',

            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',

            'description' => 'nullable|string',
            'content' => 'required|string',

            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',

            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'canonical_url' => 'nullable|url|max:255',
            'schema_markup' => 'nullable|string',

            'status' => 'required|in:draft,published',
        ]);

        // Generate slug
        $validated['slug'] = $request->slug
            ? Str::slug($request->slug)
            : Str::slug($request->title);


        // Published date handling
        if (
            $request->status === 'published' &&
            $blog->status !== 'published'
        ) {
            $validated['published_at'] = now();
        }

        if ($request->status === 'draft') {
            $validated['published_at'] = null;
        }


        // Remove tags before updating blog
        unset($validated['tags']);

        //  Thumbnail
        if ($request->hasFile('thumbnail')) {

            // Delete old thumbnail
            if (
                $blog->thumbnail &&
                Storage::disk('public')->exists($blog->thumbnail)
            ) {
                Storage::disk('public')->delete($blog->thumbnail);
            }

            $extension = $request
                ->file('thumbnail')
                ->getClientOriginalExtension();

            $filename = $blog->id
                . '-' . $validated['slug']
                . '-thumbnail.'
                . $extension;

            $path = $request
                ->file('thumbnail')
                ->storeAs(
                    'blogs/thumbnails',
                    $filename,
                    'public'
                );

            $validated['thumbnail'] = $path;
        }


        //  Banner


        if ($request->hasFile('banner')) {

            // Delete old banner
            if (
                $blog->banner &&
                Storage::disk('public')->exists($blog->banner)
            ) {
                Storage::disk('public')->delete($blog->banner);
            }

            $extension = $request
                ->file('banner')
                ->getClientOriginalExtension();

            $filename = $blog->id
                . '-' . $validated['slug']
                . '-banner.'
                . $extension;

            $path = $request
                ->file('banner')
                ->storeAs(
                    'blogs/banners',
                    $filename,
                    'public'
                );

            $validated['banner'] = $path;
        }


        //  Update Blog


        $blog->update($validated);

        //  Update Tags


        $blog->tags()->sync($request->tags ?? []);


        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully.');
    }

    //Remove the specified resource from storage.

    public function destroy(Blog  $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
