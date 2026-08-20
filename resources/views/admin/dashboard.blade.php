@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="container-fluid px-0">

    {{-- Header --}}
    <div class="mb-4">

        <h2 class="fw-bold mb-1">
            Dashboard
        </h2>

        <p class="text-muted mb-0">
            Welcome back, {{ auth()->user()->name }}.
        </p>

    </div>


    {{-- Statistics --}}
    <div class="row g-4 mb-4">

        {{-- Total Blogs --}}
        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">
                                Total Blogs
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ $totalBlogs }}
                            </h3>

                        </div>

                        <div
                            class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center"
                            style="width:50px;height:50px;"
                        >
                            <i class="bi bi-file-earmark-text fs-4"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Total Views --}}
        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">
                                Total Views
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ $totalViews }}
                            </h3>

                        </div>

                        <div
                            class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center"
                            style="width:50px;height:50px;"
                        >
                            <i class="bi bi-eye fs-4"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Total Likes --}}
        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">
                                Total Likes
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ $totalLikes }}
                            </h3>

                        </div>

                        <div
                            class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center"
                            style="width:50px;height:50px;"
                        >
                            <i class="bi bi-heart fs-4"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Total Comments --}}
        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">
                                Total Comments
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ $totalComments }}
                            </h3>

                        </div>

                        <div
                            class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center"
                            style="width:50px;height:50px;"
                        >
                            <i class="bi bi-chat-dots fs-4"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Categories --}}
        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">
                                Categories
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ $totalCategories }}
                            </h3>

                        </div>

                        <div
                            class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center"
                            style="width:50px;height:50px;"
                        >
                            <i class="bi bi-folder fs-4"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Tags --}}
        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">
                                Tags
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ $totalTags }}
                            </h3>

                        </div>

                        <div
                            class="bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center"
                            style="width:50px;height:50px;"
                        >
                            <i class="bi bi-tags fs-4"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Total Users --}}
        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">
                                Total Users
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ $totalUsers }}
                            </h3>

                        </div>

                        <div
                            class="bg-secondary bg-opacity-10 text-secondary rounded-circle d-flex align-items-center justify-content-center"
                            style="width:50px;height:50px;"
                        >
                            <i class="bi bi-people fs-4"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Most Viewed Blogs --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 p-4">

            <h5 class="fw-semibold mb-1">
                Most Viewed Blogs
            </h5>

            <p class="text-muted small mb-0">
                Blogs ranked by view count
            </p>

        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>
                        <th class="px-4">#</th>
                        <th>Blog</th>
                        <th>Views</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($topBlogs as $blog)

                        <tr>

                            <td class="px-4 fw-semibold">
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $blog->title }}
                            </td>

                            <td>
                                <span class="badge bg-dark">
                                    {{ $blog->views }}
                                </span>
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="3"
                                class="text-center py-4 text-muted"
                            >
                                No blogs found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection