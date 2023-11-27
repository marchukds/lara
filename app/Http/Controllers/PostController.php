<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')->paginate(7);
        return view('blog.index', ['posts' => $posts]);
    }

    public function show(int $id) {
        $post = DB::table('posts')->find($id);
        return view('blog.show', ['post' => $post]);
    }
}
