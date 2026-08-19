@extends('layouts.admin')

@section('title', 'Add Tag')
@section('page-title', 'Add Tag')

@section('content')

<div class="container-fluid px-0">

    {{-- Page Header --}}

    <div class="container-fluid px-0">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h4 class="fw-bold mb-0">
                Add Tag
            </h4>

            <a href="{{ route('admin.tags.index') }}"
                class="btn btn-secondary">
                Back
            </a>

        </div>


        {{-- Validation Errors --}}
        @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

        @endif


        {{-- Form --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <form
                    method="POST"
                    action="{{ route('admin.tags.store') }}">

                    @csrf


                    <div class="row g-3">

                        {{-- Tag Name --}}
                        <div class="col-md-6">

                            <label
                                for="name"
                                class="form-label">

                                Tag Name
                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                class="form-control"
                                placeholder="Enter tag name"
                                required>

                            @error('name')

                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>


                        {{-- Slug --}}
                        <div class="col-md-6">

                            <label
                                for="slug"
                                class="form-label">

                                Slug

                            </label>

                            <input
                                type="text"
                                id="slug"
                                name="slug"
                                value="{{ old('slug') }}"
                                class="form-control bg-light"
                                placeholder="tag-slug"
                                readonly>

                            <small class="text-muted">
                                Slug will be generated automatically.
                            </small>

                        </div>

                    </div>


                    {{-- Buttons --}}
                    <div class="mt-4">

                        <button
                            type="submit"
                            class="btn btn-danger">

                            Save Tag

                        </button>


                        <a
                            href="{{ route('admin.tags.index') }}"
                            class="btn btn-secondary ms-2">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- Slug Generation --}}
    <script>
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        nameInput.addEventListener('input', function() {

            let slug = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

            slugInput.value = slug;

        });
    </script>

    @endsection