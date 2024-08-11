@section('scripts')
    @vite([ 'resources/js/like.helper.js'])
@stop

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between w-full">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $post->title }}
                </h2>
                <h3>
                    @if(Auth::user()->id !== $post->user_id)
                        Autor: {{$post->user->name}},
                    @else
                        Autor: Ty :D,
                    @endif
                    Tag: {{$post->tag}}
                </h3>
                <h3>
                    Czas utworzenia: {{$post->created_at->diffForHumans()}}
                    @if ($post->created_at != $post->updated_at)
                        | Ostatnia aktualizacja: {{$post->updated_at->diffForHumans()}}
                    @endif
                </h3>
            </div>
            @if(Auth::user()->id == $post->user_id)
                <x-like-dislike :post="$post"/>
            @endif
            <div class="flex items-center gap-0.5">
                @if(Auth::user()->id == $post->user_id)
                    <div>
                        <a href="{{ route('posts.edit', $post) }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edytuj</a>
                    </div>
                    <div>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Usuń
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex flex-row gap-2">
                        <input type="hidden" id="postId" value="{{$post->id}}">
                        <div>
                            <button id="like"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fa-solid fa-thumbs-up"></i> <span id="likes_count">{{ $post->likes }}</span>
                            </button>
                        </div>
                        <div>
                            <button id="dislike"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fa-solid fa-thumbs-down"></i> <span id="dislikes_count">{{ $post->dislikes }}</span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </x-slot>

    @if($post->photo)
        <div class="pt-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex justify-center">
                    @if(str_starts_with($post->photo, 'http'))
                        <img src="{{ $post->photo }}" alt="Post image" class="max-h-64">
                    @else
                        <img src="{{ Storage::url($post->photo) }}" alt="Post image" class="max-h-64">
                    @endif
                </div>
            </div>
        </div>
    @endif

    <div class="pt-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="remove-all-styles">
                    {!! $post->html !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
