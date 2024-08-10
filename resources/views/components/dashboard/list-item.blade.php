@props(['post'])

<div class="flex justify-between w-full		">
    <div>
        <div class="underline text-xl font-bold	">{{ $post->title }}</div>
        <div>Tag: {{ $post->tag }}</div>
        <div>Stworzone: {{ $post->created_at->diffForHumans() }}</div>
        @if($post->created_at != $post->updated_at)
            <div>Zmodyfikowane: {{ $post->updated_at->diffForHumans() }}</div>
        @endif
    </div>
    <div class="flex items-center">
        <div>
            <a href="{{ route('posts.edit', $post) }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edytuj</a>
        </div>
        <div>
            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Usuń
                </button>
            </form>
        </div>
    </div>
</div>
