<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $image = $request->image->store('posts');
        // $post = $request->all();
        // dd($post, $image);
        // $post->image = $image;
        // $post->published_at = date("Y/m/d");

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'published_at' =>$request->published_at,
        ]);
        session()->flash('success', 'Post created');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        dd('show post');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }
    /**
     * Show only trashed posts
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        //dd(Post::withTrashed());
        //$trashed = Post::withTrashed()->get();
        $trashed = Post::onlyTrashed()->get();
        //dd('show trashed', $trashed);
        return view('posts.index')->withPosts($trashed);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)//not using RMB due to trashed posts
    {
        //$this->authorize('update', $post);
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $redir = '/posts';
        if($post->trashed())
        {
            Storage::delete($post->image);
            $redir = '/trashed-posts';
            $post->forceDelete();
        }
        else{
            $post->delete();
        }
        session()->flash('success', 'post deleted');

        return redirect($redir);

    }
}
