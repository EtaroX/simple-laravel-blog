<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $post->title }}
            </h2>
            <h3>{{$post->user->name}}</h3>
        </div>
    </x-slot>

    <div class="pt-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                {!! $post->html !!}
            </div>
        </div>
    </div>
</x-app-layout>
