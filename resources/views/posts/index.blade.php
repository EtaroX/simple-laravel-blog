<x-app-layout>
        <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Feed') }}
        </h2>
    </x-slot>

<div>
    <ul>
        @foreach ($posts as $post)
            <li class="px-7 py-1">
                    <x-posts.list-item :post="$post" />
            </li>
            <hr>
        @endforeach
    </ul>
    <div class="pt-5">
        {{ $posts->links() }}
    </div>
</div>
</x-app-layout>
