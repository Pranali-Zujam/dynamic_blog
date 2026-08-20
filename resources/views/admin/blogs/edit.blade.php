@extends('layouts.admin')

@section('title', 'Edit Blog')
@section('page-title', 'Edit Blog')

@section('content')

<div class="container-fluid px-0">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h4 class="fw-bold mb-0">
            Edit Blog
        </h4>

        <a href="{{ route('admin.blogs.index') }}"
            class="btn btn-secondary">
            Back
        </a>

    </div>

    <form
        method="POST"
        action="{{ route('admin.blogs.update', $blog->id) }}"
        enctype="multipart/form-data">

        @csrf

        @method('PUT')


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
                            value="{{ old('title', $blog->title) }}"
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
                                {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>

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

                            <option
                                value="draft"
                                {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>

                                Draft

                            </option>

                            <option
                                value="published"
                                {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>

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
                            value="{{ old('slug', $blog->slug) }}"
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
                            value="{{ old('seo_title', $blog->seo_title) }}"
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
                            value="{{ old('canonical_url', $blog->canonical_url) }}"
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
                            required>{{ old('description', $blog->description) }}</textarea>

                    </div>


                    {{-- Content --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Content <span class="text-danger">*</span>
                        </label>
                        <textarea
                            name="content"
                            id="blog-content"
                            rows="8"
                            class="form-control"
                            placeholder="Write blog content...">{{ old('content', $blog->content) }}</textarea>

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


                    {{-- Thumbnail --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Thumbnail
                        </label>

                        @if($blog->thumbnail)

                        <div class="mb-2">

                            <img
                                src="{{ asset('storage/' . $blog->thumbnail) }}"
                                alt="{{ $blog->title }}"
                                class="img-thumbnail"
                                style="max-height: 120px;">

                        </div>

                        @endif

                        <input
                            type="file"
                            name="thumbnail"
                            class="form-control"
                            accept="image/*">

                        <small class="text-muted">
                            Leave empty to keep the existing thumbnail.
                        </small>

                    </div>


                    {{-- Banner --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Banner
                        </label>

                        @if($blog->banner)

                        <div class="mb-2">

                            <img
                                src="{{ asset('storage/' . $blog->banner) }}"
                                alt="{{ $blog->title }}"
                                class="img-thumbnail"
                                style="max-height: 120px; max-width: 100%;">

                        </div>

                        @endif

                        <input
                            type="file"
                            name="banner"
                            class="form-control"
                            accept="image/*">

                        <small class="text-muted">
                            Leave empty to keep the existing banner.
                        </small>

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
                            placeholder="SEO description">{{ old('seo_description', $blog->seo_description) }}</textarea>

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
                            placeholder="Enter JSON schema">{{ old('schema_markup', $blog->schema_markup) }}</textarea>

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


                @php

                $selectedTags = old(
                'tags',
                $blog->tags->pluck('id')->toArray()
                );

                @endphp


                @forelse($tags as $tag)

                <div class="form-check form-check-inline">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="tags[]"
                        value="{{ $tag->id }}"
                        id="tag{{ $tag->id }}"
                        {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }}>

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

                Update Blog

            </button>

        </div>

    </form>

</div>


{{-- Slug --}}
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
@push('scripts')

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const editorElement = document.getElementById('blog-content');

        if (!editorElement) {
            return;
        }

        CKEDITOR.ClassicEditor
            .create(editorElement, {

                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'underline',
                        'link',
                        '|',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'alignment',
                        'blockQuote',
                        'uploadImage',
                        'insertTable',
                        '|',
                        'sourceEditing',
                        '|',
                        'undo',
                        'redo'
                    ],
                    shouldNotGroupWhenFull: true
                },

                image: {
                    toolbar: [
                        'imageTextAlternative',
                        'imageStyle:inline',
                        'imageStyle:block',
                        'imageStyle:side'
                    ]
                },
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },

                simpleUpload: {
                    uploadUrl: "{{ route('admin.blogs.content-image') }}",

                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                },

                removePlugins: [
                    'AIAssistant',
                    'MultiLevelList',
                    'TableOfContents',
                    'PasteFromOfficeEnhanced',
                    'CaseChange',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    'MathType',
                    'SlashCommand',
                    'DocumentOutline',
                    'FormatPainter',
                    'Template'
                ]

            })

            .then(editor => {

                console.log('CKEditor loaded successfully');

                const form = editorElement.closest('form');

                if (form) {
                    form.addEventListener('submit', function() {
                        editor.updateSourceElement();
                    });
                }

            })

            .catch(error => {
                console.error('CKEditor Error:', error);
            });

    });
</script>

@endpush

@endsection