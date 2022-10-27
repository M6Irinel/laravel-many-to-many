<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Post;
use App\Category;
use App\Mail\SendPostCreatedMail;
use App\Tag;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ControllerPost extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->get();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        $tags = Tag::orderBy('name', 'asc')->get();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = Post::validate_for_create($request);

        if(array_key_exists('image', $params)){
            $params['image'] = Storage::put('uploads', $params['image']);
        }

        $params['slug'] = Post::slug($params);

        $post = Post::create($params);

        if (array_key_exists('tags', $params)) {
            $post->tags()->sync($params['tags']);
        }

        // Mail::to($request->user())->send(new SendPostCreatedMail());
        Mail::to('ciccio.pasticcio@gmail.com')->send(new SendPostCreatedMail($post));

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();

        $tags = Tag::orderBy('name', 'asc')->get();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $params = Post::validate_for_update($request, $post);
        
        if(array_key_exists('image', $params)){
            if($post->image && Storage::exists($post->image)){
                Storage::delete($post->image);
            }
            $params['image'] = Storage::put('uploads', $params['image']);
        }


        if ($params['title'] !== $post->title) {
            $params['slug'] = Post::slug($params);
        }

        if (array_key_exists('tags', $params)) {
            $post->tags()->sync($params['tags']);
        }

        $post->update($params);

        return redirect()->route('admin.posts.show', compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $img = $post->image;

        $post->delete();

        if($img && Storage::exists($img)){
            Storage::delete($img);
        }

        return redirect()->route('admin.posts.index');
    }
}
