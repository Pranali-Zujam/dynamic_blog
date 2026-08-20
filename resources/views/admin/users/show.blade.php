@extends('layouts.admin')

@section('title', 'User Details')
@section('page-title', 'User Details')

@section('content')

<div class="container-fluid px-0">

    {{-- Back Button --}}
    <div class="mb-4">
        <a
            href="{{ route('admin.users.index') }}"
            class="btn btn-outline-secondary btn-sm"
        >
            &larr; Back to Users
        </a>
    </div>


    <div class="row g-4">

        {{-- User Details --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 p-4">

                    <div class="d-flex align-items-center">

                        <div
                            class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center fw-bold me-3"
                            style="width: 55px; height: 55px;"
                        >
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1">
                                {{ $user->name }}
                            </h5>

                            <p class="text-muted small mb-0">
                                {{ $user->email }}
                            </p>
                        </div>

                    </div>

                </div>


                <div class="card-body p-4">

                    <h6 class="fw-semibold mb-4">
                        Account Information
                    </h6>

                    <div class="row g-4">

                        <div class="col-md-6">

                            <div class="text-muted small mb-1">
                                Name
                            </div>

                            <div class="fw-semibold">
                                {{ $user->name }}
                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="text-muted small mb-1">
                                Email
                            </div>

                            <div class="fw-semibold">
                                {{ $user->email }}
                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="text-muted small mb-1">
                                Role
                            </div>

                            @if($user->role === 'admin')

                                <span class="badge bg-dark">
                                    Admin
                                </span>

                            @else

                                <span class="badge bg-light text-dark border">
                                    User
                                </span>

                            @endif

                        </div>


                        <div class="col-md-6">

                            <div class="text-muted small mb-1">
                                Joined
                            </div>

                            <div class="fw-semibold">
                                {{ $user->created_at->format('d M Y') }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Activity --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 p-4">
                    <h5 class="fw-semibold mb-0">
                        User Activity
                    </h5>
                </div>


                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">

                        <div>
                            <div class="text-muted small">
                                Total Likes
                            </div>

                            <div class="fw-bold fs-4">
                                {{ $user->likes_count }}
                            </div>
                        </div>

                        <span class="text-danger fs-4">
                            ♥
                        </span>

                    </div>


                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <div class="text-muted small">
                                Total Comments
                            </div>

                            <div class="fw-bold fs-4">
                                {{ $user->comments_count }}
                            </div>
                        </div>

                        <span class="text-dark fs-4">
                            💬
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection