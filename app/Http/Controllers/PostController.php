<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function delete(Post $post) {
        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }
        $post->delete();
        return redirect('/');
    }

    public function updatePost(Post $post,Request $request ) {
        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }
        $Formfields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $post->update($Formfields);
        return redirect('/');
    }
    public function showEditScreen(Post $post) {
          if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }
        return view('edit-post', ['post'=> $post]);
    }

    public function createPost(Request $request) {
        $Formfields = $request->validate([
            "title"=> "required",
            "body"=> "required",
        ]);
        $Formfields["title"] = strip_tags($Formfields['title']);
        $Formfields["body"] = strip_tags($Formfields['body']);
        $Formfields['user_id'] = auth()->id();
        Post::create($Formfields);
        return redirect('/');
        }
}
