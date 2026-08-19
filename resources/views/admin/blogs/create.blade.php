@extends('layouts.admin')

@section('title', 'Create Blog')
@section('page-title', 'Create Blog')

@section('content')

<div class="container-fluid px-0">

<div class="d-flex justify-content-between align-items-center mb-4">

    <h4 class="fw-bold mb-0">
        Create Blog
    </h4>

    <a href="{{ route('admin.blogs.index') }}"
       class="btn btn-secondary">
        Back
    </a>

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


    <form
        method="POST"
        action="{{ route('admin.blogs.store') }}"
        enctype="multipart/form-data">

        @csrf


        {{-- Blog Details --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body p-4">

                <h5 class="fw-semibold mb-4">
                    Blog Details
                </h5>

                <div class="row g-3">


                    {{-- Title --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Title <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title') }}"
                            class="form-control"
                            placeholder="Enter blog title"
                            required>

                    </div>


                    {{-- Category --}}
                    <div class="col-md-3">

                        <label class="form-label">
                            Category <span class="text-danger">*</span>
                        </label>

                        <select
                            name="category_id"
                            class="form-select"
                            required>

                            <option value="">
                                Select
                            </option>

                            @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>

                                {{ $category->name }}

                            </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Status --}}
                    <div class="col-md-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="draft"
                                {{ old('status') == 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>

                            <option value="published"
                                {{ old('status') == 'published' ? 'selected' : '' }}>
                                Published
                            </option>

                        </select>

                    </div>


                    {{-- Slug --}}
                    <div class="col-md-4">

                        <label class="form-label">
                            Slug
                        </label>

                        <input
                            type="text"
                            name="slug"
                            id="slug"
                            value="{{ old('slug') }}"
                            class="form-control"
                            placeholder="blog-title">

                    </div>


                    {{-- SEO Title --}}
                    <div class="col-md-4">

                        <label class="form-label">
                            SEO Title
                        </label>

                        <input
                            type="text"
                            name="seo_title"
                            value="{{ old('seo_title') }}"
                            class="form-control"
                            placeholder="SEO title">

                    </div>


                    {{-- Canonical --}}
                    <div class="col-md-4">

                        <label class="form-label">
                            Canonical URL
                        </label>

                        <input
                            type="url"
                            name="canonical_url"
                            value="{{ old('canonical_url') }}"
                            class="form-control"
                            placeholder="https://example.com/blog">

                    </div>


                    {{-- Description --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Description <span class="text-danger">*</span>
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            class="form-control"
                            placeholder="Short description"
                            required>{{ old('description') }}</textarea>

                    </div>


                    {{-- Content --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Content <span class="text-danger">*</span>
                        </label>

                        <textarea
                            name="content"
                            rows="4"
                            class="form-control"
                            placeholder="Write blog content..."
                            required>{{ old('content') }}</textarea>

                    </div>

                </div>

            </div>

        </div>


        {{-- Images --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body p-4">

                <h5 class="fw-semibold mb-4">
                    Images
                </h5>

                <div class="row g-3">

                    <div class="col-md-6">

                        <label class="form-label">
                            Thumbnail
                        </label>

                        <input
                            type="file"
                            name="thumbnail"
                            class="form-control"
                            accept="image/*">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Banner
                        </label>

                        <input
                            type="file"
                            name="banner"
                            class="form-control"
                            accept="image/*">

                    </div>

                </div>

            </div>

        </div>


        {{-- SEO --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body p-4">

                <h5 class="fw-semibold mb-4">
                    SEO Details
                </h5>

                <div class="row g-3">

                    {{-- SEO Description --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            SEO Description
                        </label>

                        <textarea
                            name="seo_description"
                            rows="4"
                            class="form-control"
                            placeholder="SEO description">{{ old('seo_description') }}</textarea>

                    </div>


                    {{-- Schema --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Schema Markup
                        </label>

                        <textarea
                            name="schema_markup"
                            rows="4"
                            class="form-control"
                            placeholder="Enter JSON schema">{{ old('schema_markup') }}</textarea>

                    </div>

                </div>

            </div>

        </div>


        {{-- Tags --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body p-4">

                <h5 class="fw-semibold mb-3">
                    Tags
                </h5>

                @forelse($tags as $tag)

                <div class="form-check form-check-inline">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="tags[]"
                        value="{{ $tag->id }}"
                        id="tag{{ $tag->id }}"
                        {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>

                    <label
                        class="form-check-label"
                        for="tag{{ $tag->id }}">

                        {{ $tag->name }}

                    </label>

                </div>

                @empty

                <span class="text-muted">
                    No tags available.
                </span>

                @endforelse

            </div>

        </div>


        {{-- Buttons --}}
        <div class="d-flex justify-content-end gap-2 mb-4">

            <a
                href="{{ route('admin.blogs.index') }}"
                class="btn btn-secondary">

                Cancel

            </a>

            <button
                type="submit"
                class="btn btn-danger">

                Create Blog

            </button>

        </div>

    </form>

</div>


<script>
    document.getElementById('title').addEventListener('input', function() {

        let slug = this.value
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');

        document.getElementById('slug').value = slug;

    });
</script>

@endsection