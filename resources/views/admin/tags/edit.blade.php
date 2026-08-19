@extends('layouts.admin')

@section('title', 'Edit Tag')
@section('page-title', 'Edit Tag')

@section('content')

<div class="container-fluid px-0">

    <div class="mb-4">

        <h4 class="fw-bold mb-1">
            Edit Tag
        </h4>

        <p class="text-muted mb-0">
            Update the tag information.
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
                action="{{ route('admin.tags.update', $tag) }}">

                @csrf
                @method('PUT')


                <div class="row">

                    <div class="col-md-6">

                        <label class="form-label">
                            Tag Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $tag->name) }}"
                            class="form-control"
                            required>

                    </div>

                </div>


                <div class="mt-4">

                    <a
                        href="{{ route('admin.tags.index') }}"
                        class="btn btn-secondary">

                        Cancel

                    </a>

                    <button
                        type="submit"
                        class="btn btn-danger">

                        Update Tag

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection