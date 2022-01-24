<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Post;

class PostController extends Controller
{
    public function show($id)
    {
        $post   =   \App\Models\Post::findOrFail($id);

        $this->authorize($post , 'view');   //function PostPolicy->view()       redirect to 403

        return view('post.post_show',   compact('post'));
    }
}
