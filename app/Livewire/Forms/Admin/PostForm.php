<?php

namespace App\Livewire\Forms\Admin;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PostForm extends Form
{
    public ?Post $post;

    #[Validate('required|min:5')]
    public $title = '';
    #[Validate('required|min:5')]
    public $content = '';
    #[Validate('required|integer')]
    public $status = 1;
    #[Validate('required|array')]
    public array $tags = [];
    public $oldCover;
    #[Validate('required|integer')]
    public $user_id;
    #[Validate('required|image|max:1024')] // 1MB Max
    public $cover;

    public function setPost(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->status = $post->status;
        $this->user_id = $post->user_id;
        $this->tags = $post->tags()->pluck('id')->toArray();
        $this->oldCover = $post->cover;
    }

    public function store()
    {
        $validated = $this->validate();
        $this->cover = $this->cover->store('posts', 'public');

        $post = Post::create($this->all());
        $post->tags()->sync($this->tags);
    }

    public function update()
    {
        $validated = $this->validate();
        if ($this->cover->getClientOriginalName()) {
            if ($this->oldCover !== null && Storage::disk('public')->exists($this->oldCover)) {
                Storage::disk('public')->delete($this->oldCover);
            }
            $this->cover = $this->cover->store('posts', 'public');
        }
        $this->post->update(
            $this->all()
        );
        $this->post->tags()->sync($this->tags);
    }
}
