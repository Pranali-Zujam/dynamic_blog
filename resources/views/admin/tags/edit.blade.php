<x-app-layout>

    <div class="py-12">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">
                    Edit Tag
                </h1>

                <form method="POST"
                    action="{{ route('admin.tags.update', $tag) }}">

                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block mb-2">
                            Tag Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $tag->name) }}"
                            class="w-full border rounded p-2"
                            required>

                        @error('name')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="mt-6">

                        <button
                            type="submit"
                            class="px-4 py-2 bg-green-800 hover:bg-green-700 text-white rounded">
                            Update Tag
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

</x-app-layout>