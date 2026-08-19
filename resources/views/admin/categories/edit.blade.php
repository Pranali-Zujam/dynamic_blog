@extends('layouts.admin')

@section('title', 'Edit Category')
@section('page-title', 'Edit Category')

@section('content')

<div class="container-fluid px-0">

    <div class="mb-4">

        <h4 class="fw-bold mb-1">
            Edit Category
        </h4>

        <p class="text-muted mb-0">
            Update the category information.
        </p>

    </div>


    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form
                method="POST"
                action="{{ route('admin.categories.update', $category) }}">

                @csrf
                @method('PUT')


                <div class="row">

                    <div class="col-md-6">

                        <label class="form-label">
                            Category Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $category->name) }}"
                            class="form-control"
                            required>

                    </div>

                </div>


                <div class="mt-4">

                    <a
                        href="{{ route('admin.categories.index') }}"
                        class="btn btn-secondary">

                        Cancel

                    </a>

                    <button
                        type="submit"
                        class="btn btn-danger">

                        Update Category

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection