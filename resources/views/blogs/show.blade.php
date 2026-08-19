<x-app-layout>

    <div class="py-12">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <article class="bg-white shadow-sm sm:rounded-lg overflow-hidden">

                {{-- Banner --}}
                @if($blog->banner)

                <img
                    src="{{ asset('storage/' . $blog->banner) }}"
                    alt="{{ $blog->title }}"
                    class="w-full h-72 object-cover">

                @elseif($blog->thumbnail)

                <img
                    src="{{ asset('storage/' . $blog->thumbnail) }}"
                    alt="{{ $blog->title }}"
                    class="w-full h-72 object-cover">

                @endif


                <div class="p-6 md:p-8">

                    {{-- Category --}}
                    @if($blog->category)

                    <div class="text-green-700 font-semibold mb-2">
                        {{ $blog->category->name }}
                    </div>

                    @endif


                    {{-- Title --}}
                    <h1 class="text-3xl md:text-4xl font-bold">
                        {{ $blog->title }}
                    </h1>


                    {{-- Meta --}}
                    <div class="flex flex-wrap gap-4 text-sm text-gray-500 mt-4">

                        <span>
                            By {{ $blog->user->name ?? 'Admin' }}
                        </span>

                        <span>
                            {{ $blog->published_at?->format('d M Y') }}
                        </span>

                        <span>
                            {{ $blog->views }} views
                        </span>

                    </div>


                    {{-- Tags --}}
                    @if($blog->tags->count())

                    <div class="mt-5">

                        @foreach($blog->tags as $tag)

                        <span class="inline-block bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded mr-1 mb-1">
                            #{{ $tag->name }}
                        </span>

                        @endforeach

                    </div>

                    @endif


                    {{-- Description --}}
                    @if($blog->description)

                    <div class="mt-6 text-lg text-gray-600">
                        {{ $blog->description }}
                    </div>

                    @endif


                    {{-- Content --}}
                    <div class="mt-8 text-gray-800 leading-7 whitespace-pre-line">

                        {{ $blog->content }}

                    </div>

                </div>

            </article>


            {{-- Related Blogs --}}
            @if($relatedBlogs->count())

            <div class="mt-10">

                <h2 class="text-2xl font-bold mb-5">
                    Related Blogs
                </h2>


                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    @foreach($relatedBlogs as $related)

                    <div class="bg-white shadow-sm rounded-lg border p-4">

                        @if($related->thumbnail)

                        <img
                            src="{{ asset('storage/' . $related->thumbnail) }}"
                            alt="{{ $related->title }}"
                            class="w-full h-32 object-cover rounded">

                        @endif

                        <h3 class="font-semibold mt-3">

                            {{ $related->title }}

                        </h3>

                        <a
                            href="{{ route('blogs.show', $related->slug) }}"
                            class="inline-block mt-3 text-green-700 font-semibold">
                            Read More →
                        </a>

                    </div>

                    @endforeach

                </div>

            </div>

            @endif


            <div class="mt-8">

                <a
                    href="{{ route('blogs.index') }}"
                    class="px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white rounded">
                    ← Back to Blogs
                </a>

            </div>

        </div>

    </div>

</x-app-layout>