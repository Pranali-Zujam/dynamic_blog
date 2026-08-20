@extends('layouts.admin')

@section('title', 'Categories')
@section('page-title', 'Categories')

@section('content')

<div class="container-fluid px-0">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">Categories</h4>
        </div>

        <a
            href="{{ route('admin.categories.create') }}"
            class="btn btn-danger">

            + Add Category

        </a>

    </div>

    {{-- Categories --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 p-4">

            <h5 class="fw-semibold mb-1">
                All Categories
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
                            Name
                        </th>

                        <th>
                            Slug
                        </th>

                        <th>
                            Created
                        </th>

                        <th>
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($categories as $category)

                        <tr>

                            <td class="px-4">
                                {{ $loop->iteration }}
                            </td>

                            <td>

                              
                                    {{ $category->name }}
                              

                            </td>

                            <td>

                               
                                    {{ $category->slug }}
                               

                            </td>

                            <td>

                              
                                    {{ $category->created_at->format('d M Y') }}
                              

                            </td>

<td>
    <div class="d-flex align-items-center gap-2">

        {{-- Edit --}}
        <a href="{{ route('admin.categories.edit', $category) }}"
           class="btn btn-sm btn-outline-warning">
            <i class="bi bi-pencil me-1"></i>
            Edit
        </a>

        {{-- Delete --}}
        <form method="POST"
              action="{{ route('admin.categories.destroy', $category) }}"
              onsubmit="return confirm('Are you sure you want to delete this category?')"
              class="m-0">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="btn btn-sm btn-outline-danger">
                <i class="bi bi-trash me-1"></i>
                Delete
            </button>

        </form>

    </div>
</td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="text-center py-5">

                                <p class="text-muted mb-3">
                                    No categories found.
                                </p>

                                <a
                                    href="{{ route('admin.categories.create') }}"
                                    class="btn btn-danger">

                                    Add Category

                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection

