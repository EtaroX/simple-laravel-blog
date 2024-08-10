@props(['post'])
<div class="flex justify-center items-center">
    <div class="flex flex-row w-20 h-1/2 ">
        <div class="bg-green-400 min-w-fit font-extrabold rounded-l-lg text-center p-0.5 flex gap-1 items-center justify-center"
             style="width: {{ $post->getLikeProcentage() }}%"><i class="fa-solid fa-thumbs-up"></i>{{$post->likes}}</div>
        <div class="bg-red-500 min-w-fit font-extrabold rounded-r-lg text-center p-0.5 flex gap-1 items-center justify-center"
             style="flex-grow: 1;"><i class="fa-solid fa-thumbs-down"></i>{{$post->dislikes}}</div>
    </div>
</div>
