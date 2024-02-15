<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
    
        // dd($post->photo);
        return view("posts.index", compact("posts"));
    }
    public function create()
    {
        return view("posts.create");
    }

    public function store(Request $request)
    {
        $post = Post::create($request->all());
        $post->addMediaFromRequest("photo")
             ->usingName("spatie Media")
             ->toMediaCollection("photo");
        // $post->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');

        return redirect()->route("admin.posts.index")->with("success","");
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view("posts.show", compact("post"));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
