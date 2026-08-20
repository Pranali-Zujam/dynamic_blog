@extends('layouts.admin')

@section('title', 'Blogs')
@section('page-title', 'Blogs')

@section('content')

<div class="container-fluid px-0">

    {{-- Page Header --}}
    <div class="d-flex flex-column flex-md-row
                justify-content-between align-items-md-center
                gap-3 mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Blog Posts
            </h2>

        </div>

        <a href="{{ route('admin.blogs.create') }}"
            class="btn btn-danger">

            <i class="bi bi-plus-lg me-1"></i>
            Add Blog

        </a>

    </div>
    
{{-- Search & Filters --}}
<div class="card border-0 shadow-sm mb-4">

    <div class="card-body p-4">

        <form method="GET" action="{{ route('admin.blogs.index') }}">

            <div class="row g-3">

                {{-- Search --}}
                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Search Blog
                    </label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search blogs..."
                        class="form-control">

                </div>


                {{-- Category --}}
                <div class="col-md-3">

                    <label class="form-label fw-semibold">
                        Category
                    </label>

                    <select
                        name="category"
                        class="form-select">

                        <option value="">
                            All Categories
                        </option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                @selected(request('category') == $category->id)>

                                {{ $category->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Sort --}}
                <div class="col-md-3">

                    <label class="form-label fw-semibold">
                        Sort
                    </label>

                    <select
                        name="sort"
                        class="form-select">

                        <option
                            value="newest"
                            @selected(request('sort', 'newest') === 'newest')>

                            Newest First

                        </option>

                        <option
                            value="oldest"
                            @selected(request('sort') === 'oldest')>

                            Oldest First

                        </option>

                        <option
                            value="az"
                            @selected(request('sort') === 'az')>

                            A-Z

                        </option>

                    </select>

                </div>


                {{-- Per Page --}}
                <div class="col-md-2">

                    <label class="form-label fw-semibold">
                        Per Page
                    </label>

                    <select
                        name="per_page"
                        class="form-select">

                        @foreach([10, 20, 30, 40, 50] as $size)

                            <option
                                value="{{ $size }}"
                                @selected(request('per_page', 10) == $size)>

                                {{ $size }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            <div class="mt-4">

                <button
                    type="submit"
                    class="btn btn-danger px-4">

                    <i class="bi bi-search me-1"></i>
                    Search / Filter

                </button>

                <a
                    href="{{ route('admin.blogs.index') }}"
                    class="btn btn-light border px-4 ms-2">

                    Reset

                </a>

            </div>

        </form>

    </div>

</div>

    {{-- Blog Table --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0
                    p-4 d-flex justify-content-between
                    align-items-center">

            <div>

                <h5 class="fw-bold mb-1">
                    All Blogs
                </h5>

                <small class="text-muted">
                    {{ $blogs->total() }} blog(s) found
                </small>

            </div>

        </div>


        @if($blogs->count())

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th class="px-4 py-3">
                            Image
                        </th>

                        <th class="py-3">
                            Title
                        </th>

                        <th class="py-3">
                            Category
                        </th>

                        <th class="py-3">
                            Tags
                        </th>

                        <th class="py-3">
                            Status
                        </th>

                        <th class="py-3">
                            Views
                        </th>

                        <th class="py-3 text-end px-4">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($blogs as $blog)

                    <tr>

                        {{-- Image --}}
                        <td class="px-4">

                            @if($blog->thumbnail)

                            <img
                                src="{{ asset('storage/' . $blog->thumbnail) }}"
                                alt="{{ $blog->title }}"
                                style="width:70px;height:50px;
                                                   object-fit:cover;"
                                class="rounded">

                            @else

                            <div class="bg-light rounded
                                                    text-muted
                                                    d-flex align-items-center
                                                    justify-content-center"
                                style="width:70px;height:50px;">

                                <small>No Image</small>

                            </div>

                            @endif

                        </td>


                        {{-- Title --}}
                        <td>

                            <div class="fw-semibold">

                                {{ $blog->title }}

                            </div>

                            <small class="text-muted">

                                /{{ $blog->slug }}

                            </small>

                            <br>

                            <small class="text-muted">

                                {{ $blog->created_at->format('d M Y') }}

                            </small>

                        </td>


                        {{-- Category --}}
                        <td>

                            @if($blog->category)

                            <span class="badge bg-primary-subtle
                                                     text-primary">

                                {{ $blog->category->name }}

                            </span>

                            @else

                            <span class="text-muted">
                                N/A
                            </span>

                            @endif

                        </td>


                        {{-- Tags --}}
                        <td>

                            @forelse($blog->tags as $tag)

                            <span class="badge bg-light
                                                     text-dark border
                                                     me-1 mb-1">

                                #{{ $tag->name }}

                            </span>

                            @empty

                            <span class="text-muted small">
                                No tags
                            </span>

                            @endforelse

                        </td>


                        {{-- Status --}}
                        <td>

                            @if($blog->status === 'published')

                            <span class="badge bg-success">
                                Published
                            </span>

                            @else

                            <span class="badge bg-warning
                                                     text-dark">
                                Draft
                            </span>

                            @endif

                        </td>


                        {{-- Views --}}
                        <td>



                            <i class="bi bi-eye me-1"></i>
                            {{ $blog->views }}



                        </td>


                        {{-- Actions --}}
                        <td class="text-end px-4">

                            <div class="d-flex
                                                justify-content-end
                                                gap-2">

                                <a
                                    href="{{ route('admin.blogs.edit', $blog) }}"
                                    class="btn btn-sm btn-outline-warning">

                                    <i class="bi bi-pencil"></i>
                                    Edit

                                </a>


                                <form
                                    method="POST"
                                    action="{{ route('admin.blogs.destroy', $blog) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this blog?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="btn btn-sm
                                                           btn-outline-danger">

                                        <i class="bi bi-trash"></i>
                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        <div class="card-footer bg-white border-0 p-4">

            {{ $blogs->links() }}

        </div>

        @else

        <div class="text-center py-5">

            <div class="mb-3">

                <i class="bi bi-journal-x display-4
                              text-muted"></i>

            </div>

            <h5 class="fw-bold">
                No blogs found
            </h5>

            <p class="text-muted">
                Start by creating your first blog.
            </p>

            <a href="{{ route('admin.blogs.create') }}"
                class="btn btn-success">

                <i class="bi bi-plus-lg me-1"></i>
                Create Blog

            </a>

        </div>

        @endif

    </div>

</div>


@endsection