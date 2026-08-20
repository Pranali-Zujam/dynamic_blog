<x-app-layout>

    <div class="bg-light min-vh-100 py-5">

        <div class="container">

            {{-- Header --}}
            <div class="mb-4">
                <h1 class="fw-bold text-dark mb-1">
                    Latest Blogs
                </h1>

                <p class="text-muted mb-0">
                    Explore our latest articles and insights.
                </p>
            </div>


            {{-- Search & Filter --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-3">

                    <form
                        method="GET"
                        action="{{ route('blogs.index') }}"
                        class="row g-3 align-items-center">

                        {{-- Search --}}
                        <div class="col-12 col-md-6 col-lg-7">
                            <div class="input-group">

                                <span class="input-group-text bg-white">
                                    🔍
                                </span>

                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Search blogs..."
                                    class="form-control">

                            </div>
                        </div>


                        {{-- Sort --}}
                        <div class="col-12 col-md-3 col-lg-3">

                            <select
                                name="sort"
                                class="form-select">

                                <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>
                                    Newest First
                                </option>

                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                                    Oldest First
                                </option>

                                <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>
                                    A-Z
                                </option>

                            </select>

                        </div>


                        {{-- Search Button --}}
                        <div class="col-12 col-md-3 col-lg-2">

                            <button
                                type="submit"
                                class="btn btn-dark w-100">

                                Search

                            </button>

                        </div>

                    </form>

                </div>
            </div>


            {{-- Blog Results --}}
            @if($blogs->count())

            <div class="row g-4">

                @foreach($blogs as $blog)

                <div class="col-12 col-md-6 col-lg-4">

                    <article class="card h-100 border-0 shadow-sm blog-card overflow-hidden">

                        {{-- Blog Image --}}
                        @if($blog->thumbnail)

                        <a href="{{ route('blogs.show', $blog->slug) }}">

                            <img
                                src="{{ asset('storage/' . $blog->thumbnail) }}"
                                alt="{{ $blog->title }}"
                                class="card-img-top blog-thumbnail">

                        </a>

                        @else

                        <a
                            href="{{ route('blogs.show', $blog->slug) }}"
                            class="blog-thumbnail bg-secondary-subtle d-flex align-items-center justify-content-center text-decoration-none">

                            <span class="text-muted">
                                No Image
                            </span>

                        </a>

                        @endif


                        {{-- Blog Content --}}
                        <div class="card-body d-flex flex-column p-4">

                            {{-- Category --}}
                            <div class="mb-2" style="min-height: 20px;">

                                @if($blog->category)

                                <span class="badge bg-light text-secondary border">
                                    {{ $blog->category->name }}
                                </span>

                                @endif

                            </div>


                            {{-- Title --}}
                            <h2 class="h5 fw-bold mb-2 blog-title">

                                <a
                                    href="{{ route('blogs.show', $blog->slug) }}"
                                    class="text-dark text-decoration-none">

                                    {{ $blog->title }}

                                </a>

                            </h2>


                            {{-- Description --}}
                            <p class="text-muted small mb-3 blog-description">

                                {{ Str::limit(strip_tags($blog->description), 120) }}

                            </p>


                            {{-- Meta --}}
                            <div class="flex justify-between items-center mt-4 text-xs text-gray-500">

                                <span>
                                    {{ $blog->published_at?->format('d M Y') }}
                                </span>

                                <span>
                                    {{ $blog->views }} views
                                    · {{ $blog->likes_count }} likes
                                    · {{ $blog->comments_count }} comments
                                </span>

                            </div>

                            {{-- Tags --}}
                            <div
                                class="mt-3 blog-tags"
                                style="min-height: 42px;">

                                @if($blog->tags->count())

                                @foreach($blog->tags as $tag)

                                <span class="badge bg-light text-secondary border me-1 mb-1 fw-normal">
                                    #{{ $tag->name }}
                                </span>

                                @endforeach

                                @endif

                            </div>


                            {{-- Read More --}}
                            <div class="mt-auto pt-3">

                                <a
                                    href="{{ route('blogs.show', $blog->slug) }}"
                                    class="btn btn-dark btn-sm">

                                    Read More
                                    <span class="ms-1">→</span>

                                </a>

                            </div>

                        </div>

                    </article>

                </div>

                @endforeach

            </div>


            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-5">

                {{ $blogs->links('pagination::bootstrap-5') }}

            </div>


            @else

            {{-- Empty State --}}
            <div class="card border-0 shadow-sm">

                <div class="card-body text-center py-5">

                    <div class="display-6 mb-3">
                        📝
                    </div>

                    <h2 class="h4 fw-bold text-dark">
                        No published blogs yet.
                    </h2>

                    <p class="text-muted mb-0">
                        Please check back later.
                    </p>

                </div>

            </div>

            @endif

        </div>

    </div>


    {{-- Page Styling --}}
    <style>
        .blog-card {
            transition: all 0.25s ease;
            border-radius: 12px;
        }

        .blog-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.10) !important;
        }

        .blog-thumbnail {
            width: 100%;
            height: 210px;
            object-fit: cover;
            display: block;
        }

        .blog-title {
            line-height: 1.5;
            min-height: 48px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .blog-title a {
            transition: color 0.2s ease;
        }

        .blog-title a:hover {
            color: #6c757d !important;
        }

        .blog-description {
            line-height: 1.6;
            min-height: 48px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .blog-tags {
            overflow: hidden;
            max-height: 45px;
        }

        .blog-tags .badge {
            font-size: 11px;
            padding: 5px 8px;
        }

        @media (max-width: 767px) {

            .blog-thumbnail {
                height: 200px;
            }

        }
    </style>

</x-app-layout>