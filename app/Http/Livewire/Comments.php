<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Str;

class Comments extends Component
{
    use WithPagination;   
    use WithFileUploads;
    public $image;
    public $ticketId = 1;
    public $newComment;
    protected $listeners = [
        "fileUpload" => "handleFileUpload",
        "ticketSelected"
    ];

    public function ticketSelected($ticketId)
    {
        $this->ticketId = $ticketId;
    }

    public function handleFileUpload($imageData)
    {
        $this->image = $imageData;
    }

    public function addComment()
    {
        $this->validate([
            "newComment" => "required|min:5|max:255"
        ]);
        $image = $this->storeImage();
        $created_comment = Comment::create(
            [
                "body"=>$this->newComment,
                "user_id"=>2,
                "image" => $image,
                "suport_ticket_id" => $this->ticketId
            ]);
        if($created_comment->exists){
            $this->newComment = "";
            $this->image = "";
            session()->flash("msg_success","Mensaje creado con exito");
        }else{
            session()->flash("msg_err","No se pudo crear el mensaje, intentalo mas tarde");
        }
    }

    public function storeImage()
    {
        if(!$this->image) return null;
        $img = ImageManagerStatic::make($this->image)->encode("jpg");
        $name_img = Str::random().".jpg";
        Storage::disk("public")->put($name_img,$img);
        return $name_img;
    }
    
    public function updated($field)
    {
        $this->validateOnly($field,["newComment"=>"required|min:5|max:255"]);
    }

    public function deleteComment($id)
    {
        $comment_to_delete = Comment::find($id);
        if($comment_to_delete->delete()){
            if($comment_to_delete->image != null) Storage::disk("public")->delete($comment_to_delete->image);
            session()->flash("msg_success","Mensaje eliminado con exito");
        }else{
            session()->flash("msg_err","No se pudo eliminar el mensaje, intentalo mas tarde");
        }
    }

    public function render()
    {
        return view('livewire.comments',["comments"=>Comment::where("suport_ticket_id",$this->ticketId)->latest()->paginate(10)]);
    }
}
