@extends('layouts.admin')

@section('title', 'Comments')
@section('page-title', 'Comments')

@section('content')

<div class="container-fluid px-0">

    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row
                justify-content-between align-items-md-center
                gap-3 mb-4">

        <div>
            <h4 class="fw-bold mb-1">
                Comments
            </h4>
        </div>

    </div>  
  
    {{-- Search & Filter --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body p-4">

            <form method="GET"
                action="{{ route('admin.comments.index') }}">

                <div class="row g-3">

                    {{-- Search --}}
                    <div class="col-md-8">

                        <label class="form-label fw-semibold">
                            Search
                        </label>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="Search comment, user or blog...">

                    </div>


                    {{-- Status --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="">
                                All Comments
                            </option>

                            <option
                                value="visible"
                                {{ request('status') === 'visible' ? 'selected' : '' }}>
                                Visible
                            </option>

                            <option
                                value="hidden"
                                {{ request('status') === 'hidden' ? 'selected' : '' }}>
                                Hidden
                            </option>

                        </select>

                    </div>

                </div>


                <div class="mt-3">

                    <button
                        type="submit"
                        class="btn btn-danger px-4">

                        <i class="bi bi-search me-1"></i>
                        Search

                    </button>


                    <a
                        href="{{ route('admin.comments.index') }}"
                        class="btn btn-light border px-4 ms-2">

                        Reset

                    </a>

                </div>

            </form>

        </div>

    </div>


    {{-- Comments Table --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 p-4">

            <h5 class="fw-bold mb-1">
                All Comments
            </h5>
        </div>


        @if($comments->count())

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th class="px-4 py-3">
                            User
                        </th>

                        <th class="py-3">
                            Blog
                        </th>

                        <th class="py-3">
                            Comment
                        </th>

                        <th class="py-3">
                            Status
                        </th>

                        <th class="py-3">
                            Date
                        </th>

                        <th class="py-3 text-end px-4">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($comments as $comment)

                    <tr>

                        {{-- User --}}
                        <td class="px-4">

                            <div class="fw-semibold">

                                {{ $comment->user->name ?? 'Unknown User' }}

                            </div>

                            @if($comment->user)

                            <small class="text-muted">
                                {{ $comment->user->email }}
                            </small>

                            @endif

                        </td>


                        {{-- Blog --}}
                        <td>

                            @if($comment->blog)

                            <a
                                href="{{ route('blogs.show', $comment->blog->slug) }}"
                                target="_blank"
                                class="text-decoration-none fw-semibold">

                                {{ Str::limit($comment->blog->title, 35) }}

                            </a>

                            @else

                            <span class="text-muted">
                                Blog deleted
                            </span>

                            @endif

                        </td>


                        {{-- Comment --}}
                        <td style="max-width: 350px;">

                            <div class="text-secondary">

                                {{ Str::limit($comment->comment, 100) }}

                            </div>

                        </td>


                        {{-- Status --}}
                        <td>

                            @if($comment->is_visible)

                            <span class="badge bg-success">
                                Visible
                            </span>

                            @else

                            <span class="badge bg-secondary">
                                Hidden
                            </span>

                            @endif

                        </td>


                        {{-- Date --}}
                        <td>

                            <div>
                                {{ $comment->created_at->format('d M Y') }}
                            </div>

                            <small class="text-muted">
                                {{ $comment->created_at->format('h:i A') }}
                            </small>

                        </td>


                        {{-- Actions --}}
                        <td class="text-end px-4">

                            <div class="d-flex
                                        justify-content-end
                                        gap-2">

                                {{-- Hide --}}
                                @if($comment->is_visible)

                                <form
                                    method="POST"
                                    action="{{ route('admin.comments.hide', $comment) }}">

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-warning"
                                        onclick="return confirm('Hide this comment?')">

                                        <i class="bi bi-eye-slash"></i>
                                        Hide

                                    </button>

                                </form>

                                {{-- Show --}}
                                @else

                                <form
                                    method="POST"
                                    action="{{ route('admin.comments.show', $comment) }}">

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-success">

                                        <i class="bi bi-eye"></i>
                                        Show

                                    </button>

                                </form>

                                @endif


                                {{-- Delete --}}
                                <form
                                    method="POST"
                                    action="{{ route('admin.comments.destroy', $comment) }}"
                                    onsubmit="return confirm('Are you sure you want to permanently delete this comment?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-danger">

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

            {{ $comments->links('pagination::bootstrap-5') }}

        </div>


        @else

        <div class="text-center py-5">

            <i class="bi bi-chat-square-text display-4 text-muted"></i>

            <h5 class="fw-bold mt-3">
                No comments found
            </h5>

            <p class="text-muted mb-0">
                There are no comments matching your search.
            </p>

        </div>

        @endif

    </div>

</div>



@endsection