<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\{Post, Category, Tag};
use Illuminate\Http\Request;

class PostController extends Controller
{


    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts/create', [
            'post' => new Post(),
            'categories' => Category::get(),
            'tags' => Tag::get()
        ]);
    }

    public function store(PostRequest $request)
    {
        // $post = new Post;
        // $post->title = $request->title;
        // $post->slug = \Str::slug($request->title);
        // $post->body = $request->body;
        // $post->save();

        $request->validate([
            'thumbnail' => 'image|mimes:jpg,JPEG,png|max:2048'
        ]);

        $attr = $request->all();
        $slug = \Str::slug($request->title);
        $attr['slug'] = $slug;


        $thumbnail = request()->file('thumbnail') ? request()->file('thumbnail')->store("image/posts") : null;

        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnail;

        $post = auth()->user()->posts()->create($attr);
        $post->tags()->attach(request('tags'));

        session()->flash('success', 'the post was created!');
        return redirect('posts');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::get(),
            'tags' => Tag::get()
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $request->validate([
            'thumbnail' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if (request()->file('thumbnail')) {
            \Storage::delete($post->thumbnail);
            $thumbnail = request()->file('thumbnail')->store("image/posts");
        } else {
            $thumbnail = $post->thumbnail;
        }

        $this->authorize('update', $post);
        $attr = $request->all();
        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnail;
        $post->update($attr);

        $post->tags()->sync(request('tags'));
        session()->flash('success', 'the post was Updated !');
        return redirect('posts');
    }

    public function destroy(Post $post)
    {   
        $this->authorize('delete', $post);
        \Storage::delete($post->thumbnail);
        $post->tags()->detach();
        $post->delete();

        session()->flash('success', 'Post was destroyed');
        return redirect('posts');
    }
}
