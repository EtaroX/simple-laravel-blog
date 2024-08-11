@section('scripts')
    @vite([ 'resources/js/editor.js'])
@stop

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edytowanie Posta
            </h2>
        </div>
    </x-slot>

    <div class="pt-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form action="{{ route('posts.update', $post) }}" id="formEdit" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Tytuł</label>
                        <input type="text" name="title" id="title" value="{{ $post->title }}"
                               class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="tag" class="block text-sm font-medium text-gray-700">Tag</label>
                        <input type="text" name="tag" id="tag" value="{{ $post->tag }}"
                               class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="photo" class="block text-sm font-medium text-gray-700">Podmień zdjęcie na nowe (Najlepiej w proporcjach 5/1) </label>
                        <input type="file" accept="image/*" name="photo" id="photo" value="" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label for="editor" class="block text-sm font-medium text-gray-700">Treść</label>
                        <input type="hidden" name="body" id="content" value="{{$post->body}}">
                        <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                    </div>
                    <div class="mb-4">
                        <button type="submit"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Zapisz
                        </button>
                        <a href="{{ route('posts.index') }}"
                           class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Anuluj</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

