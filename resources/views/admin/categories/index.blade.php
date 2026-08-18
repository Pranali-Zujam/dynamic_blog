<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold">Categories</h2>
                    <a href="{{ route('admin.categories.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Add Category
                    </a>
                </div>

                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert" id="clearMsg">
                    <strong class="font-bold">Success! </strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
                @endif

                <table class="w-full border ">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border px-4 py-2">#</th>
                            <th class="border px-4 py-2">Name</th>
                            <th class="border px-4 py-2">Slug</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td class="border px-4 py-2">{{ $category->id }}</td>
                            <td class="border px-4 py-2">{{ $category->name }}</td>
                            <td class="border px-4 py-2">{{ $category->slug }}</td>
                            <td class="border px-4 py-2">
                                <div class="flex items-center gap-2">

                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                        class="inline-flex items-center justify-center w-12 h-10 rounded-lg
              bg-blue-50 text-blue-600 hover:bg-blue-100 transition"
                                        title="Edit Category">

                                        Edit

                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $category) }}"
                                        method="POST"
                                        class="inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="inline-flex items-center justify-center w-16 h-10 rounded-lg
                       bg-red-50 text-red-600 hover:bg-red-100 transition"
                                            title="Delete Category"
                                            onclick="return confirm('Are you sure you want to delete this category?')">

                                            Delete

                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="border px-4 py-2 text-center">No categories found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

</x-app-layout>

<script>
    let clearMsg = document.getElementById('clearMsg');
    if (clearMsg) {
        setTimeout(() => {
            clearMsg.style.display = 'none';
        }, 3000);
    }
</script>