<?php

namespace App\Livewire\Admin\Posts;

use App\Enums\PostStatus;
use App\Livewire\Forms\Admin\PostForm;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Edit Product')]
class UpdatePost extends Component
{
    use WithFileUploads;

    public PostForm $form;

    public array $users;
    public array $postStatus;
    public array $tags;


    public function mount(Post $post)
    {
        $this->form->setPost($post);
        $this->users = User::all('id', 'name')->toArray();
        $this->tags = Tag::all('id', 'name')->toArray();
        $this->postStatus = PostStatus::asArray();
    }

    public function save()
    {
        $this->form->update();
        return $this->redirect('/admin/posts');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.posts.update-post');
    }
}
