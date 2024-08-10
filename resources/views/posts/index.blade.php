<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Feed') }}
        </h2>
    </x-slot>

    <div class="pt-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form action="{{ route('posts.index') }}" method="GET" class="flex justify-center gap-5 items-center">
                    <div class="w-1/2">
                        <input type="text" name="q" id="search" class="w-full p-2 border border-gray-300 rounded-md"
                               placeholder="Search" value="{{ app('request')->input('q')  }}">
                    </div>
                    <div class="">
                        <button id="searchButton"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="pt-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <ul>
                    @foreach ($posts as $post)
                        <li class="px-7 py-1">
                            <x-posts.list-item :post="$post"/>
                        </li>
                        <hr>
                    @endforeach
                </ul>
                <div class="pt-5">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
