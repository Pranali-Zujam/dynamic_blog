<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <h1 class="text-2xl font-bold">
                        Admin Dashboard
                    </h1>

                    <p class="mt-2 text-gray-600">
                        Welcome, {{ auth()->user()->name }}
                    </p>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>