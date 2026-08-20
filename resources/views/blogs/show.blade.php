<x-app-layout>
    <div class="blog-page py-4">
        <div class="container">

            {{-- Back Navigation --}}
            <div class="mb-3">
                <a href="{{ route('blogs.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    &larr; Back to Blogs
                </a>
            </div>
            {{-- Breadcrumb --}}
            <div class="mb-4 text-sm text-gray-500">

                <a
                    href="{{ route('blogs.index') }}"
                    class="hover:text-gray-800">
                    Blogs
                </a>

                <span class="mx-2">/</span>

                @if($blog->category)
                <span>{{ $blog->category->name }}</span>
                <span class="mx-2">/</span>
                @endif

                <span class="text-gray-800">
                    {{ $blog->title }}
                </span>

            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">

                    {{-- Main Article Card --}}
                    <article class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">

                        {{-- Hero Image --}}
                        @php $image = $blog->banner ?? $blog->thumbnail; @endphp
                        @if($image)
                        <div class="article-hero position-relative">
                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $blog->title }}" class="w-100 article-hero-image">
                            <div class="article-overlay"></div>
                            @if($blog->category)
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-white text-dark shadow-sm rounded-pill px-3 py-2 fw-semibold">
                                    {{ $blog->category->name }}
                                </span>
                            </div>
                            @endif
                        </div>
                        @endif

                        {{-- Article Content Body --}}
                        <div class="card-body p-4 p-md-5">

                            {{-- Fallback Category --}}
                            @if(!$image && $blog->category)
                            <div class="mb-2">
                                <span class="badge bg-primary-subtle text-primary fw-semibold rounded-pill px-3 py-2">
                                    {{ $blog->category->name }}
                                </span>
                            </div>
                            @endif

                            {{-- Title --}}
                            <h1 class="fw-bold text-dark h2 mb-3 lh-sm">
                                {{ $blog->title }}
                            </h1>

                            {{-- Metadata Row --}}
                            <div class="d-flex flex-wrap align-items-center gap-2 mb-3 text-muted small">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="author-avatar">
                                        {{ strtoupper(substr($blog->user->name ?? 'A', 0, 1)) }}
                                    </div>
                                    <span class="fw-semibold text-dark">{{ $blog->user->name ?? 'Admin' }}</span>
                                </div>
                                <span class="text-black-50">&bull;</span>
                                @if($blog->published_at)
                                <span>{{ $blog->published_at->format('M d, Y') }}</span>
                                <span class="text-black-50">&bull;</span>
                                @endif
                                <span>{{ $blog->views }} views</span>
                            </div>

                            {{-- Tags --}}
                            @if($blog->tags->count())
                            <div class="mb-3">
                                @foreach($blog->tags as $tag)
                                <span class="badge bg-light text-secondary border me-1 rounded-pill px-2.5 py-1 font-monospace fw-normal">
                                    #{{ $tag->name }}
                                </span>
                                @endforeach
                            </div>
                            @endif

                            {{-- Excerpt --}}
                            @if($blog->description)
                            <div class="p-3 bg-light border-start border-3 border-dark rounded-end mb-4 text-secondary italic">
                                {{ $blog->description }}
                            </div>
                            @endif

                            <hr class="my-4 opacity-10">
                            {{-- Table of Contents --}}
                            @if(!empty($toc))

                            <div class="bg-light border rounded-3 p-3 mb-4">

                                <h5 class="fw-bold mb-2">
                                    Table of Contents
                                </h5>

                                <ul class="mb-0 ps-3">

                                    @foreach($toc as $item)

                                    <li class="mb-1">
                                        <a
                                            href="#{{ $item['id'] }}"
                                            class="text-decoration-none text-dark">
                                            {{ $loop->iteration }}. {{ $item['title'] }}
                                        </a>
                                    </li>

                                    @endforeach

                                </ul>

                            </div>

                            @endif
                            <hr class="my-4 opacity-10">

                            {{-- Article Content --}}
                            <div class="article-content text-dark lh-lg mb-4">
                                {!! $content !!}
                            </div>

                            {{-- Engagement Bar --}}
                            <div class="d-flex align-items-center justify-content-between pt-3 border-top mt-5">
                                <div class="d-flex gap-4 text-muted small">
                                    <span><strong class="text-dark">{{ $blog->likes->count() }}</strong> Likes</span>
                                    <span><strong class="text-dark">{{ $blog->comments->count() }}</strong> Comments</span>
                                </div>

                                <div>
                                    @auth
                                    <form method="POST" action="{{ route('blogs.like', $blog) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm {{ $liked ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-3">
                                            {{ $liked ? '♥ Liked' : '♡ Like' }}
                                        </button>
                                    </form>
                                    @else
                                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                        Login to Like
                                    </a>
                                    @endauth
                                </div>
                            </div>

                        </div>
                    </article>

                    {{-- Comments Section --}}
                    <section class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4">
                        <div class="border-bottom pb-3 mb-4">
                            <h4 class="fw-bold text-dark mb-0">Comments</h4>
                            <span class="text-muted small">
                                {{ $blog->comments->count() }} {{ Str::plural('comment', $blog->comments->count()) }}
                            </span>
                        </div>

                        {{-- Comment Form --}}
                        @auth
                        <form method="POST" action="{{ route('blogs.comment', $blog) }}" class="mb-4">
                            @csrf
                            <div class="mb-2">
                                <textarea name="comment" rows="3" required placeholder="Share your thoughts..." class="form-control rounded-3 @error('comment') is-invalid @enderror"></textarea>
                                @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-dark btn-sm rounded-pill px-4">
                                    Post Comment
                                </button>
                            </div>
                        </form>
                        @else
                        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
                            <div>
                                <strong class="d-block text-dark small">Want to join the conversation?</strong>
                                <span class="text-muted extra-small">Log in to leave a comment.</span>
                            </div>
                            <a href="{{ route('login') }}" class="btn btn-dark btn-sm rounded-pill px-3">
                                Login
                            </a>
                        </div>
                        @endauth

                        {{-- Comment List --}}
                        <div class="d-flex flex-column gap-3">
                            @forelse($blog->comments as $index => $comment)
                            <div class="comment-item d-flex gap-3 pb-3 border-bottom last-border-0 {{ $index >= 5 ? 'd-none' : '' }}">
                                <div class="comment-avatar flex-shrink-0">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>
                                <div class="w-100">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="fw-semibold text-dark small">{{ $comment->user->name }}</span>
                                        <span class="text-muted extra-small" style="font-size: 0.75rem;">
                                            {{ $comment->created_at->format('d M Y, h:i A') }}
                                        </span>
                                    </div>
                                    <p class="text-secondary small mb-0">{{ $comment->comment }}</p>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-4 text-muted">
                                <div class="fs-3 mb-1">💬</div>
                                <h6 class="fw-semibold mb-1">No comments yet</h6>
                                <p class="small mb-0">Be the first to share your thoughts.</p>
                            </div>
                            @endforelse

                            @if($blog->comments->count() > 5)
                            <div class="text-center mt-3">
                                <button
                                    type="button"
                                    id="viewAllComments"
                                    class="btn btn-outline-dark btn-sm rounded-pill px-4">
                                    View All Comments ({{ $blog->comments->count() }})
                                </button>
                            </div>
                            @endif
                        </div>
                    </section>

                    {{-- Related Articles Section --}}
                    @if($relatedBlogs->count())
                    <section class="mt-5">
                        <div class="mb-3">
                            <h4 class="fw-bold text-dark mb-0">Related Articles</h4>
                            <p class="text-muted small mb-0">You might also like these articles.</p>
                        </div>

                        <div class="row g-3">
                            @foreach($relatedBlogs as $related)
                            <div class="col-12 col-md-4">
                                <article class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden related-card">
                                    @if($related->thumbnail)
                                    <a href="{{ route('blogs.show', $related->slug) }}">
                                        <img src="{{ asset('storage/' . $related->thumbnail) }}" alt="{{ $related->title }}" class="w-100" style="height: 140px; object-fit: cover;">
                                    </a>
                                    @else
                                    <div class="bg-light text-muted d-flex align-items-center justify-content-center small" style="height: 140px;">
                                        No Image
                                    </div>
                                    @endif

                                    <div class="card-body p-3 d-flex flex-column">
                                        @if($related->category)
                                        <span class="extra-small text-muted mb-1" style="font-size: 0.75rem;">
                                            {{ $related->category->name }}
                                        </span>
                                        @endif
                                        <h6 class="fw-bold text-dark mb-2 line-clamp-2" style="font-size: 0.9rem;">
                                            <a href="{{ route('blogs.show', $related->slug) }}" class="text-dark text-decoration-none">
                                                {{ $related->title }}
                                            </a>
                                        </h6>
                                        <a href="{{ route('blogs.show', $related->slug) }}" class="text-primary fw-semibold small text-decoration-none mt-auto" style="font-size: 0.8rem;">
                                            Read Article &rarr;
                                        </a>
                                    </div>
                                </article>
                            </div>
                            @endforeach
                        </div>
                    </section>
                    @endif

                </div>
            </div>
        </div>
    </div>

    {{-- Cleaned & Compact Styling Rules --}}
    <style>
        .blog-page {
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .article-hero {
            height: 340px;
            overflow: hidden;
        }

        .article-hero-image {
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .article-hero:hover .article-hero-image {
            transform: scale(1.02);
        }

        .article-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.05), rgba(0, 0, 0, 0.25));
        }

        .author-avatar,
        .comment-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #212529;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
        }

        .article-content {
            font-size: 1.05rem;
            color: #2b2f33;
        }

        .related-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .related-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .08) !important;
        }

        .last-border-0:last-child {
            border-bottom: none !important;
        }

        .extra-small {
            font-size: 0.8rem;
        }
    </style>
    <script>
        document.getElementById('viewAllComments')?.addEventListener('click', function() {

            const hiddenComments = document.querySelectorAll('.comment-item');

            hiddenComments.forEach(function(comment, index) {
                if (index >= 5) {
                    comment.classList.toggle('d-none');
                }
            });

            if (this.innerText.startsWith('View')) {
                this.innerText = 'Hide Comments';
            } else {
                this.innerText = 'View All Comments ({{ $blog->comments->count() }})';
            }

        });
    </script>
</x-app-layout>