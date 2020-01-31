<?php

namespace App\Http\Controllers;

use App\Catagory;
use App\Tag;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use Illuminate\Http\Request;

use App\Post;

use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyCatagoriesCount')->only(['create', 'store']);
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('catagories', Catagory::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {

        $post = new Post;

        $post->Title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;
        $post->published_at = $request->published_at;
        $post->catagory_id = $request->catagory;
        $post->user_id = $request->auth()->user()->id;
        if ($request->hasFile('image')) {

            $post->image = $request->image->store('public/images');
        }

        $post->save();

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        session()->flash('success', 'Post Created Successfully');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post)->with('catagories', Catagory::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'published_at', 'content']);

        if ($request->hasFile('image')) {
            $image = $request->image->store('public/images');
            $post->deleteImage();
            $data['image'] = $image;
        }

        $post->update($data);

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        session()->flash('success', 'Post Updates Successfully');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if ($post->trashed()) {
            $post->deleteImage();
            $post->forceDelete();
        } else {
            $post->delete();
        }


        session()->flash('success', 'Post Trashed Successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Display trash post
     *
     *
     * @return \Illuminate\Http\Response
     */


    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->with('posts', $trashed);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();
        session()->flash('success', 'Post Restored Successfully');
        return redirect()->back();
    }
}
