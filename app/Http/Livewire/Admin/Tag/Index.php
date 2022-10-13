<?php

namespace App\Http\Livewire\Admin\Tag;

use App\Models\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    public $title;
    public $description;
    public $color;
    public $tag_id;
    protected $rules = [
        'title' => ['required','min:3'],
        'color'=>['required']
    ];

    public function render()
    {
        $tags = Tag::paginate(20);
        return view('livewire.admin.tag.index')->with(["tags" => $tags]);
    }

    public function edit(Tag $tag){
        $this->authorize('update',$tag);
        $this->title = $tag->title;
        $this->description=$tag->description();
        $this->color=$tag->color;
        $this->tag_id = $tag->id;
        $this->emit('editTag');
    }

    public function deleteConfirm(Tag $tag){
        $this->authorize('delete',$tag);
        $this->title = $tag->title;
        $this->tag_id = $tag->id;
        $this->emit('deleteTag');
    }
    public function update(Tag $tag)
    {
        $this->authorize('update',$tag);
        $this->validate();
        $tag->update(["title" => $this->title,"description"=>$this->description,"color"=>$this->color]);
        $this->reset(['title','tag_id','color','description']);
        $this->emit('closeModal');
    }
    public function delete(Tag $tag)
    {
        $this->authorize('delete',$tag);
        $tag->delete();
        $this->reset(['title','tag_id','color','description']);
        $this->emit('closeModal');
    }
    public function store()
    {
        // dd($this->title);
        $this->authorize('create',Tag::class);
        // dd($this->title);
        $this->validate();
        Tag::create(["title" => $this->title,"description"=>$this->description,"color"=>$this->color]);
        $this->emit('closeModal');
    }
}
