@extends('layouts.admin')

@section('title', 'Users')
@section('page-title', 'Users')

@section('content')

<div class="container-fluid px-0">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">
                Users
            </h4>
        </div>

    </div>


    {{-- Users Card --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 p-4">

            <h5 class="fw-semibold mb-1">
                All Users
            </h5>
        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th class="px-4">
                            #
                        </th>

                        <th>
                            User
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Role
                        </th>

                        <th>
                            Joined
                        </th>

                        <th>
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($users as $user)

                        <tr>

                            {{-- Number --}}
                            <td class="px-4">
                                {{ $users->firstItem() + $loop->index }}
                            </td>


                            {{-- User --}}
                            <td>

                                <div class="d-flex align-items-center gap-2">

                                    <div
                                        class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center fw-semibold"
                                        style="width: 38px; height: 38px;"
                                    >
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>

                                    <div>

                                        <div class="fw-semibold">
                                            {{ $user->name }}
                                        </div>

                                        <small class="text-muted">
                                            User #{{ $user->id }}
                                        </small>

                                    </div>

                                </div>

                            </td>


                            {{-- Email --}}
                            <td class="text-muted">
                                {{ $user->email }}
                            </td>


                            {{-- Role --}}
                            <td>

                                @if($user->role === 'admin')

                                    <span class="badge bg-dark">
                                        Admin
                                    </span>

                                @else

                                    <span class="badge bg-light text-dark border">
                                        User
                                    </span>

                                @endif

                            </td>


                            {{-- Joined --}}
                            <td class="text-muted">
                                {{ $user->created_at->format('d M Y') }}
                            </td>


                            {{-- Action --}}
                            <td>

                                <a
                                    href="{{ route('admin.users.show', $user) }}"
                                    class="btn btn-sm btn-outline-dark"
                                >
                                    <i class="bi bi-eye me-1"></i>
                                    View
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="text-center py-5"
                            >

                                <p class="text-muted mb-0">
                                    No users found.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Pagination --}}
    @if($users->hasPages())

        <div class="mt-4">
            {{ $users->links() }}
        </div>

    @endif

</div>

@endsection