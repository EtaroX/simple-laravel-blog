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
                <h3>{{$post->user->name}}</h3>
            </div>
            @if(Auth::user()->id == $post->user_id)
                <div class="flex justify-center items-center">
                            <div class="flex flex-row w-20 h-1/2 ">
            <div class="bg-green-400 font-extrabold rounded-l-lg text-center p-0.5" style="width: {{ $post->getLikeProcentage() }}%">{{$post->likes}}</div>
            <div class="bg-red-500 font-extrabold rounded-r-lg text-center p-0.5" style="flex-grow: 1;">{{$post->dislikes}}</div>
        </div>
                </div>
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
                    <div>
                        <input type="hidden" id="postId" value="{{$post->id}}">
                        <div>
                            <button id="like"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Lubię to
                            </button>
                        </div>
                        <div>
                            <button id="dislike"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Nie lubię
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </x-slot>

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
