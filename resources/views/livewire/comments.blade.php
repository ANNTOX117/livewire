<div class="flex">
    <div class="w-11/12">
        <h1 class="text-3xl">Comments</h1>
        @if (session()->has("msg_success"))
            <div class="p-2 bg-green-300 text-green-800 rounded text-center">{{session("msg_success")}}</div>
        @endif
        @if (session()->has("msg_err"))
            <div class="p-2 bg-red-300 text-red-800 rounded text-center">{{session("msg_err")}}</div>
        @endif
        <section>
            @if ($image)
                <img src="{{$image}}" alt="" width="200">
            @endif
            <input type="file" id="image" wire:change="$emit('fileChoose')">
        </section>
        <form class="my-4 flex" wire:submit.prevent="addComment">
            <input type="text" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="What's in your mind." wire:model.debounce.500ms="newComment">
            <div class="py-2">
                <button type="submit" class="p-2 bg-blue-500 w-20 rounded shadow text-white">Add</button>
            </div>
        </form>
        @error('newComment')
            <span class="text-red-500 text-xs">{{$message}}</span>
        @enderror
        @foreach ($comments as $comment)
        <div class="rounded border shadow p-3 my-2">
            <div class="flex justify-between my-2">
                <div class="flex">
                    <p class="font-bold text-lg">{{$comment->creator->name}}</p>
                    <p class="mx-3 py-1 text-xs text-gray-500 font-semibold">
                        {{$comment->created_at->diffForHumans()}}
                    </p>
                </div>
                <i class="fas fa-times text-red-200 hover:text-red-600 cursor-pointer" wire:click="deleteComment({{$comment->id}})"></i>
            </div>
            <p class="text-gray-800">{{$comment->body}}</p>
            @if ($comment->image)
                <img src="{{"storage/".$comment->image}}" alt=""/>
            @endif
        </div>
        @endforeach

        {{$comments->links()}}
    </div>
</div> 
    

<script>
    window.livewire.on("fileChoose",() =>{
        let inputField = document.getElementById("image");
        let file = inputField.files[0];
        let reader = new FileReader();
        reader.onloadend = ()=>{
            //console.log(reader.result);
            window.livewire.emit("fileUpload",reader.result);
        }
        reader.readAsDataURL(file);
    })
</script>