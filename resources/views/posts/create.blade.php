@section('scripts')
        @vite([ 'resources/js/editor.js'])
@stop

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Stwórz nowego posta :D
        </h2>
        </div>
    </x-slot>

    <div class="pt-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form action="{{ route('posts.store') }}" id="formEdit" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Tytuł</label>
                        <input type="text" name="title" id="title" value="" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="tag" class="block text-sm font-medium text-gray-700">Tag</label>
                        <input type="text" name="tag" id="tag" value="" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="photo" class="block text-sm font-medium text-gray-700">Zdjęcie (Najlepiej w proporcjach 5/1) </label>
                        <input type="file" accept="image/*" name="photo" id="photo" value="" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="editor" class="block text-sm font-medium text-gray-700">Treść</label>
                        <input type="hidden" name="body" id="content" value="">
                        <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                    </div>
                    <div class="mb-4">
                        <button  type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Zapisz</button>
                        <a href="{{ route('posts.index') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Anuluj</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

