@props(['post'])

<a href="{{ route('posts.show', $post) }}" class="flex justify-between w-full">
    <div>
    <div class="underline text-xl font-bold	">{{ $post->title }}</div>
    <div>Tag: {{ $post->tag }}</div>
    </div>
    <div>
        <div class="flex flex-row w-20 h-1/2 ">
            <div class="bg-green-400 font-extrabold rounded-l-lg text-center p-0.5" style="width: {{ $post->getLikeProcentage() }}%">{{$post->likes}}</div>
            <div class="bg-red-500 font-extrabold rounded-r-lg text-center p-0.5" style="flex-grow: 1;">{{$post->dislikes}}</div>
        </div>
    </div>
    <div>
    <div>{{ $post->user->name }}</div>
    <div>{{ $post->created_at->diffForHumans() }}</div>
    </div>
</a>
