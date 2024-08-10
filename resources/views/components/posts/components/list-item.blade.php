@props(['post'])

<a href="{{ route('posts.show', $post) }}" class="flex justify-between w-full		">
    <div>
    <div class="underline text-xl font-bold	">{{ $post->title }}</div>
    <div>Tag: {{ $post->tag }}</div>
    </div>
    <div>
    <div>{{ $post->user->name }}</div>
    <div>{{ $post->created_at->diffForHumans() }}</div>
    </div>
</a>
