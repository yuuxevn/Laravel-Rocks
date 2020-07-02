<?php

namespace App\Http\Controllers;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(Tag $tag)
    {   
        $posts = $tag->posts()->latest()->paginate(6);
        return view('posts.index', compact('posts', 'tag')); 
    }
}
