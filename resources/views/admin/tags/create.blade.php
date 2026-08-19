<x-app-layout>

    <div class="py-12">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">
                    Add Tag
                </h1>

                <form method="POST" action="{{ route('admin.tags.store') }}">

                    @csrf
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="w-full md:w-1/2">
                            <label for="name" class="block mb-2">
                                Tag Name
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                class="w-full border rounded p-2"
                                required>

                            @error('name')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="w-full md:w-1/2">
                            <label for="slug" class="block mb-2">
                                Slug
                            </label>

                            <input
                                type="text"
                                id="slug"
                                name="slug"
                                value="{{ old('slug') }}"
                                class="w-full border rounded p-2 bg-gray-100"
                                readonly>
                        </div>
                    </div>

                    <div class="mt-6">

                        <button
                            type="submit"
                            class="px-4 py-2 bg-green-800 hover:bg-green-700 text-white rounded">
                            Save Tag
                        </button>

                        <a
                            href="{{ route('admin.tags.index') }}"
                            class="ml-3 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

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

</x-app-layout>