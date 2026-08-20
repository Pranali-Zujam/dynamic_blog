@extends('layouts.admin')

@section('title', 'Tags')
@section('page-title', 'Tags')

@section('content')

<div class="container-fluid px-0">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="fw-bold mb-1">
                Tags
            </h4>
        

        </div>


        <a
            href="{{ route('admin.tags.create') }}"
            class="btn btn-danger">

            + Add Tag

        </a>

    </div>
 
    {{-- Table --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 p-4">

            <h5 class="fw-semibold mb-1">
                All Tags
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

                    @forelse($tags as $tag)

                        <tr>

                            <td class="px-4">
                                {{ $loop->iteration }}
                            </td>

                            <td>

                                
                                  {{ $tag->name }}
                                

                            </td>

                            <td>

                                
                                    {{ $tag->slug }}
                               

                            </td>

                            <td>

                             
                                    {{ $tag->created_at->format('d M Y') }}
                              

                            </td>

                           <td>
    <div class="d-flex align-items-center gap-2">

        {{-- Edit --}}
        <a href="{{ route('admin.tags.edit', $tag) }}"
           class="btn btn-sm btn-outline-warning text-nowrap">
            <i class="bi bi-pencil me-1"></i>
            Edit
        </a>

        {{-- Delete --}}
        <form method="POST"
              action="{{ route('admin.tags.destroy', $tag) }}"
              onsubmit="return confirm('Are you sure you want to delete this tag?')"
              class="m-0">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="btn btn-sm btn-outline-danger text-nowrap">
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
                                    No tags found.
                                </p>

                                <a
                                    href="{{ route('admin.tags.create') }}"
                                    class="btn btn-danger">

                                    Add Tag

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

