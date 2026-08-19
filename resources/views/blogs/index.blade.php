<x-app-layout>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8">

                <h1 class="text-3xl font-bold">
                    Latest Blogs
                </h1>

                <p class="text-gray-600 mt-2">
                    Explore our latest articles and insights.
                </p>

            </div>


            @if($blogs->count())

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach($blogs as $blog)

                        <article class="bg-white shadow-sm rounded-lg overflow-hidden border">

                            {{-- Image --}}
                            @if($blog->thumbnail)

                                <img
                                    src="{{ asset('storage/' . $blog->thumbnail) }}"
                                    alt="{{ $blog->title }}"
                                    class="w-full h-48 object-cover"
                                >

                            @else

                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500">
                                        No Image
                                    </span>
                                </div>

                            @endif


                            <div class="p-5">

                                {{-- Category --}}
                                @if($blog->category)

                                    <span class="text-sm text-green-700 font-semibold">
                                        {{ $blog->category->name }}
                                    </span>

                                @endif


                                {{-- Title --}}
                                <h2 class="text-xl font-bold mt-2">

                                    <a
                                        href="{{ route('blogs.show', $blog->slug) }}"
                                        class="hover:text-green-700"
                                    >
                                        {{ $blog->title }}
                                    </a>

                                </h2>


                                {{-- Description --}}
                                <p class="text-gray-600 mt-3">

                                    {{ Str::limit($blog->description, 120) }}

                                </p>


                                {{-- Meta --}}
                                <div class="flex justify-between items-center mt-4 text-sm text-gray-500">

                                    <span>
                                        {{ $blog->published_at?->format('d M Y') }}
                                    </span>

                                    <span>
                                        {{ $blog->views }} views
                                    </span>

                                </div>


                                {{-- Tags --}}
                                @if($blog->tags->count())

                                    <div class="mt-4">

                                        @foreach($blog->tags as $tag)

                                            <span class="inline-block bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded mr-1 mb-1">
                                                #{{ $tag->name }}
                                            </span>

                                        @endforeach

                                    </div>

                                @endif


                                {{-- Read More --}}
                                <div class="mt-5">

                                    <a
                                        href="{{ route('blogs.show', $blog->slug) }}"
                                        class="inline-block px-4 py-2 bg-green-800 hover:bg-green-700 text-white rounded"
                                    >
                                        Read More
                                    </a>

                                </div>

                            </div>

                        </article>

                    @endforeach

                </div>


                <div class="mt-8">

                    {{ $blogs->links() }}

                </div>

            @else

                <div class="bg-white rounded-lg shadow-sm p-8 text-center">

                    <h2 class="text-xl font-semibold">
                        No published blogs yet.
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Please check back later.
                    </p>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>