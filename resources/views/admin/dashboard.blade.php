@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="container-fluid px-0">

    {{-- =========================
         DASHBOARD HEADER
    ========================= --}}

    <div class="mb-4">

        <h2 class="fw-bold mb-1">
            Dashboard
        </h2>

        <p class="text-muted mb-0">
            Welcome back, {{ auth()->user()->name }}.
                   </p>

    </div>


    {{-- =========================
         STATISTICS
    ========================= --}}

    <div class="row g-4 mb-4">


        {{-- Total Blogs --}}

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between
                                align-items-center">

                        <div>

                            <p class="text-muted mb-1">
                                Total Blogs
                            </p>

                            <h2 class="fw-bold mb-0">
                                {{ $totalBlogs }}
                            </h2>

                        </div>

                        <div
                            class="bg-danger bg-opacity-10
                                   text-danger rounded-circle
                                   d-flex align-items-center
                                   justify-content-center"
                            style="width:55px;height:55px;">

                            <i class="bi bi-file-earmark-text fs-4"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Total Categories --}}

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between
                                align-items-center">

                        <div>

                            <p class="text-muted mb-1">
                                Categories
                            </p>

                            <h2 class="fw-bold mb-0">
                                {{ $totalCategories }}
                            </h2>

                        </div>

                        <div
                            class="bg-primary bg-opacity-10
                                   text-primary rounded-circle
                                   d-flex align-items-center
                                   justify-content-center"
                            style="width:55px;height:55px;">

                            <i class="bi bi-folder fs-4"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Total Tags --}}

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between
                                align-items-center">

                        <div>

                            <p class="text-muted mb-1">
                                Tags
                            </p>

                            <h2 class="fw-bold mb-0">
                                {{ $totalTags }}
                            </h2>

                        </div>

                        <div
                            class="bg-success bg-opacity-10
                                   text-success rounded-circle
                                   d-flex align-items-center
                                   justify-content-center"
                            style="width:55px;height:55px;">

                            <i class="bi bi-tags fs-4"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


</div>

@endsection